<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Thông tin phường</h3>
                        </div>
                        <form action="" method="post" novalidate="novalidate">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Tên phường</label>
                                <?php
                                    $sql = "select TenPhuong from phuong where ID=".$_SESSION['phuong'];
                                    $query = mysqli_query($conn, $sql);
                                    $result = mysqli_fetch_array($query);
                                    echo '<input id="ten-phuong" type="text" class="form-control" aria-required="true" aria-invalid="false" value="'.$result[0].'">';
                                ?>
                            </div>
                            <div>
                                <button id="payment-button" onClick="doiTenPhuong()" type="button" class="btn btn-lg btn-info" style="float: right">
                                    <span id="payment-button-amount">Thay đổi</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <h3 class="title-5 m-b-35">Hình ảnh phường</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="images/bg-title-01.jpg" alt="Card image cap">
                            <div class="card-body">
                                <div class="table-data-feature">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Up">
                                                    <i class="zmdi zmdi-chevron-up"></i>
                                    </button>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Down">
                                        <i class="zmdi zmdi-chevron-down"></i>
                                    </button>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="images/bg-title-01.jpg" alt="Card image cap">
                            <div class="card-body">
                                <div class="table-data-feature">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Up">
                                                    <i class="zmdi zmdi-chevron-up"></i>
                                    </button>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Down">
                                        <i class="zmdi zmdi-chevron-down"></i>
                                    </button>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <input id="file" type="file" required="" />
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small" onClick="upHinh()">
                                <i class="zmdi zmdi-plus"></i>Thêm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function doiTenPhuong()
    {
        $.ajax({
            url:"process_ajax.php", type:"POST", dataType:"text", data:{ processID:1, IDPhuong: $phuongID, tenPhuong:$("#ten-phuong").val() }, 
    		success: function(result) 
			{
                alert("Đã thay đổi.");
			}
        })
    }
    
    function upHinh()
    {
        //Lấy ra files
        var file_data = $('#file').prop('files')[0];
        //lấy ra kiểu file
        var type = file_data.type;
        //Xét kiểu file được upload
        var match = ["image/gif", "image/png", "image/jpg",];
        //kiểm tra kiểu file
        if (type == match[0] || type == match[1] || type == match[2]) {
            //khởi tạo đối tượng form data
            var form_data = new FormData();
            //thêm files vào trong form data
            form_data.append('file', file_data);
            //sử dụng ajax post
            $.ajax({
                url: 'process_ajax.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: {
                    form_data,
                },
                type: 'post',
                success: function (res) { alert(res);
                    $('#file').val('');
                }
            });
        } else {
            alert('Chỉ được upload file ảnh');
            $('#file').val('');
        }
        return false;
    }
</script>