<?php
/**
 *
 */
class gdzLookBook extends ObjectModel
{

    public $id_reel;

    public static $definition = array(
        'table' => 'gdz_lookbook',
        'primary' => 'id_lookbook',
        'multilang' => false,
        'fields' => array(
            'id_reel' =>    array('type' => self::TYPE_INT, 'validate' => 'isunsignedInt'),
        )
    );

    public function __construct($id = null, $getProduct = false, $id_lang = null, $id_shop = null)
    {
        parent::__construct($id, $id_lang, $id_shop);
        $this->prefix = _DB_PREFIX_;
        if ($getProduct) {
            $this->getProduct();
        }
    }
    public function getProduct()
    {
        $sql = "SELECT lp.duration, lp.id_product FROM {$this->prefix}gdz_lookbook l
        INNER JOIN {$this->prefix}gdz_lookbook_product lp ON l.id_lookbook = lp.id_lookbook
        WHERE l.id_lookbook = {$this->id}";
        $rs = Db::getInstance()->executeS($sql);
        $products = array();
        foreach ($rs as $row) {
            $product = new Product($row['id_product']);
            $product->duration = $row['duration'];
            $product->groups = $this->getAttributeGroups($product);
            $products[] = $product;
        }
        $this->products = $products;
    }
    public function getAttributeGroups($product)
    {
        $context = Context::getContext();
        $attributes_groups = $product->getAttributesGroups($context->language->id);
        $groups = array();
        foreach ($attributes_groups as $k => $row) {
            if (!isset($groups[$row['id_attribute_group']])) {
                $groups[$row['id_attribute_group']] = array(
                    'group_name' => $row['group_name'],
                    'name' => $row['public_group_name'],
                    'group_type' => $row['group_type'],
                    'default' => -1,
                );
            }
            $groups[$row['id_attribute_group']]['attributes'][$row['id_attribute']] = array(
                'name' => $row['attribute_name'],
                'html_color_code' => $row['attribute_color'],
            );
            if ($row['default_on'] && $groups[$row['id_attribute_group']]['default'] == -1) {
                $groups[$row['id_attribute_group']]['default'] = (int) $row['id_attribute'];
            }
        }
        return $groups;
    }
    public function addProduct($product)
    {
        return Db::getInstance()->insert('gdz_lookbook_product', array(
            'id_lookbook' => (int)$this->id,
            'id_product'  => (int)$product->id,
            'duration'    => (int)$product->duration
        ));
    }
    public function deleteProduct($id_product)
    {
        return Db::getInstance()->delete(
            'gdz_lookbook_product',
            "id_lookbook = {$this->id} AND id_product = {$id_product}"
        );
    }
    public function updateProduct($id_product, $duration)
    {
        return Db::getInstance()->update(
            'gdz_lookbook_product',
            array(
                'duration' => $duration < 1 ? 1 : $duration,
            ),
            "id_lookbook = {$this->id} AND id_product = {$id_product}"
        );
    }
    public function deleteProducts()
    {
        $db = Db::getInstance();
        $prefix = _DB_PREFIX_;
        $sql = "DELETE FROM {$prefix}gdz_lookbook_product
        WHERE id_lookbook = {$this->id}";
        return $db->query($sql);
    }
    public function delete()
    {
        $this->deleteProducts();
        return parent::delete();
    }
    public function isProductExist($id_product)
    {
        $db = Db::getInstance();
        $prefix = _DB_PREFIX_;
        $sql = "SELECT COUNT(*) FROM {$prefix}gdz_lookbook_product
        WHERE id_lookbook = {$this->id} AND id_product = {$id_product}";
        return $db->getValue($sql);
    }
}