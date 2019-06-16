					</div>
                </div>
                <!-- <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Assakabrasa 2019</span>
                        </div>
                    </div>
                </footer> -->
            </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
        	<i class="fas fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_excluir" tabindex="-1" role="dialog" aria-labelledby="tituloModalBase" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="user" action="" method="post" enctype="multpart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 my-3">
                                    <h5 class="mb-0"><b></b></h5>
                                    <p class="mt-1" style="font-size: 15px">OBS: A ação não poderá ser desfeita</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Confirmar <i class="fas fa-trash"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="<?php echo URLROOT; ?>/vendor/jquery/jquery.min.js"></script>
        <script src="<?php echo URLROOT; ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="<?php echo URLROOT; ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="<?php echo URLROOT; ?>/js/sb-admin-2.min.js"></script>
        <!-- Page level plugins -->
        <script src="<?php echo URLROOT; ?>/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo URLROOT; ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo URLROOT; ?>/vendor/mask/jquery.mask.js"></script>
        <script src="<?php echo URLROOT; ?>/vendor/bootstrap-ajax-typeahead/js/typeahead.js"></script>

        <!-- Page level custom scripts -->
        <script src="<?php echo URLROOT; ?>/js/demo/datatables-demo.js"></script>
        <script type="text/javascript">
            $("#btn-actions").click(function(){
                $(".panel-action").fadeToggle();
            })

            $("#modal_excluir").on("show.bs.modal", function(e) {
                var link = $(e.relatedTarget);
                var text = link.attr("text");

                if(link.attr("modal-size")!= undefined){
                    $(this).find(".modal-dialog").attr('class', 'modal-dialog'+link.attr("modal-size"))
                } else{
                    $(this).find(".modal-dialog").attr('class', 'modal-dialog')
                }
                $(this).find("form").attr("action", link.attr("href"));
                $(this).find("b").text(text)
                $(this).find(".modal-title").html(link.attr("title"));
            });

            $('.money').mask("#.##0,00", {reverse: true});
        </script>
    </body>
</html>