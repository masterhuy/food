{$message}

<fieldset>
	<legend>Settings</legend>
	<form method="post">
		<p>
			<label for="MOD_gdz_reels_NAME">Name:</label>
			<input id="MOD_gdz_reels_NAME" name="MOD_gdz_reels_NAME" type="text" value="{$MOD_gdz_reels_NAME}" />
		</p>
		<p>
			<label for="MOD_gdz_reels_COLOR">Color:</label>
			<input id="MOD_gdz_reels_COLOR" name="MOD_gdz_reels_COLOR" type="text" value="{$MOD_gdz_reels_COLOR}" />
		</p>
		<p>
			<label>&nbsp;</label>
			<input id="submit_{$module_name}" name="submit_{$module_name}" type="submit" value="Save" class="button" />
		</p>
	</form>
</fieldset>
