<div class="row" id="footer">
	
	<footer class="footer mt-auto py-3 bg-light text-center">
		<div class="container">
			<span class="text-muted">&copy;2021 prajapati akash</span>
		</div>
	</footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<?php if(session()->has('admin_id') && isset($admin)) { ?>
<script src="<?= base_url("/external/js/userdata.js") ?>" type="text/javascript"></script>
<?php  }
if(session()->has('user_id') && isset($user)) { ?>
<script src="<?= base_url("/external/js/loaddata.js") ?>" type="text/javascript"></script>
<?php } ?>
<script src="<?= base_url("/external/js/loadimg.js") ?>" type="text/javascript"></script>
</body>
</html>