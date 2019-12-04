<div class="section__content section__content--p30" id="div-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="margin-top:10px">
                <!-- DATA TABLE -->
                <h3 class="title-5 m-b-35">Quản lý sản phẩm</h3>
                <div class="table-data__tool">
                    <div class="table-data__tool-right">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small" onClick="edit()">
                            <i class="zmdi zmdi-plus"></i>Thêm</button>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Tiêu đề</th>
                                <th>Nội dung</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="tr-shadow">
                                <td>Lori Lynch</td>
                                <td>a</td>
                                <td>
                                    <div class="table-data-feature">
                                        <button type="button" class="item" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>

<script src="ckeditor\ckeditor.js"></script>
<script>
    var soanThao='<div class="card-body"><div class="card-title"><h3 class="text-center title-2">Thông tin bài viết</h3></div><form action="" method="post" novalidate="novalidate"><div class="form-group"><label for="cc-payment" class="control-label mb-1">Tiêu đề</label><input id="cc-pament" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false"></div><div class="form-group"><label for="cc-payment" class="control-label mb-1">Nội dung</label><textarea name="textarea-input" id="editor" rows="9" class="form-control"></textarea></div><div class="table-data__tool"><div class="table-data__tool-right"><button type="button" class="btn btn-secondary" onclick="cancel()">Cancel</button><button type="button" class="btn btn-primary">Confirm</button></div></div></form></div>';
    
    function edit()
    {
        $content=$("#div-content").html();
        $("#div-content").html(soanThao);
        CKEDITOR.replace( 'editor' );
    }
    
    function cancel()
    {
        $("#div-content").html($content);
    }
</script>  