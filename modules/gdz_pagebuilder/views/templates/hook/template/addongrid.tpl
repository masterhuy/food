<style type="text/css">
.grid_column {
    min-height: 50px;
    flex: 1;
    text-align: center;
    border: 1px dashed #888;
    margin: 5px;
}
</style>
  <div class="grid_row row">
      <%
      screen = grid_column.split('-');
      cols = [];
      sm = screen[1].split(',');
      xs = screen[2].split(',');
      screen[0].split(',').forEach(function(col, i) {
        cols.push({
          lg: col,
          sm: sm[i]?sm[i]:12,
          xs: xs[i]?xs[i]:12,
        });
      });
      _.each(cols, function(col, i) { %>
          <div class="col-lg-<%= col.lg %> col-sm-<%= col.sm %> col-xs-<%= col.xs %> grid_column addon-sortable dragenterable" lg="<%= col.lg %>" sm="<%= col.sm %>" xs="<%= col.xs %>">
          </div>
      <% }) %>
  </div>

<%
component = $('#gdz-configuration').data('component');
if(component) {
  $(component).on('update', function() {
    $(component).find('.addon-sortable').sortable({
        scroll: true,
        scrollSensitivity: 100,
        scrollSpeed: 13,
        placeholder: "ui-state-highlight",
        connectWith: ".addon-sortable"
    });
  })
}
%>