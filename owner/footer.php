			<div class="col-sm-12">
				<p class="back-link">2020 &copy; Made with <i class="fa fa-heart"></i> by Irfandi Iqbal Abimanyu</p>
			</div>
		</div><!--/.row -->
	</div><!--/.main-->
	
	<script src="../assets/js/jquery-1.11.1.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/datatables/datatables.min.js"></script>
	<script src="../assets/toast/js/jquery.toast.js"></script>
	
	<script>
		$('#btn_hapus').on('click',() => {
			return confirm('Yakin Menghapus data ?');
		});
		
		$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();
				var t = $('#table').DataTable({
					"columnDefs": [{
						"searchable": false,
						"orderable": false,
						"targets": 0
					}],
					"order": [[ 1, 'asc' ]],
					"language" : {
						"sProcessing" : "Sedang memproses ...",
						"lengthMenu" : "Tampilkan _MENU_ data per halaman",
						"zeroRecord" : "Maaf data tidak tersedia",
						"info" : "Menampilkan _PAGE_ halaman dari _PAGES_ halaman",
						"infoEmpty" : "Menampilkan _PAGE_ halaman dari _PAGES_ halaman",
						"emptyTable" : "Tidak ada data yang tersedia",
						"infoFiltered" : "(difilter dari _MAX_ total data)",
						"sSearch" : "Cari",
						"oPaginate" : {
							"sFirst" : "Pertama",
							"sPrevious" : "Sebelumnya",
							"sNext" : "Selanjutnya",
							"sLast" : "Terakhir"
						}
					}
				});
        t.on( 'order.dt search.dt', function () {
        	t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
						cell.innerHTML = i+1;
					} );
				}).draw();
		});

		$('#btn-refresh').on('click',() => {
			$('#ic-refresh').addClass('fa-spin');
			var oldURL = window.location.href;
			var index = 0;
			var newURL = oldURL;
			index = oldURL.indexOf('?');
			if(index == -1){
				window.location = window.location.href;	
			}
			if(index != -1){
				window.location = oldURL.substring(0,index)
			}
		});
    </script>

    <?php if(isset($_GET['crud']) == 'true'): ?>
    <script type="text/javascript">
			var title = "<?php echo $_GET['title']?>";
			var msg = "<?php echo $_GET['msg']?>";
			var type = "<?php echo $_GET['type']?>";
			$.toast({
				heading: title,
				text: msg,
				position: 'top-right',
				loaderBg: '#fff',
				icon: type,
				hideAfter: 3500,
				stack: 6
			})
		</script> 
		<?php endif; ?>
		
</body>
</html>