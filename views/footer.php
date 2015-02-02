</div>
<div id="footer">
	<div id="copyright">
		<p>Todos los derechos reservados <?php echo APP_NAME;?> <br /><span class="icon-office" style="color:#E2B608;"></span><?php echo (isset($this->empresa[0]['Ciudad'])) ? $this->empresa[0]['Ciudad'] : ''; ?><br /><a href="#" class="terms">Terminos y Condiciones</a></p>
	</div>
</div>    
<?php
	if (isset($this->js)){
	        foreach ($this->js as $js){
	            echo '<script src="'.URL.'views/'.$js.'"></script>';
	        }
	    }
?>
<script src="public/boostrap/js/bootstrap.min.js"></script>
<script src="public/boostrap/js/bootstrap-dialog.js"></script>
<script src="public/flatui/js/bootstrap-select.js"></script>
<script src="public/flatui/js/bootstrap-switch.js"></script>
<script src="public/flatui/js/radiocheck.js"></script>
<script src="public/flatui/js/flatui-checkbox.js"></script>
<script src="public/flatui/js/flatui-radio.js"></script>
<script src="public/flatui/js/fileinput.js"></script>
<script src="public/flatui/js/jquery.tagsinput.js"></script>
<script src="public/flatui/js/jquery.placeholder.js"></script>
<script src="public/flatui/js/jquery.stacktable.js"></script>
<script src="public/flatui/js/application.js"></script>
</body>
</html>