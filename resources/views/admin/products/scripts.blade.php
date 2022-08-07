<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

        $('#details').summernote({
            height: 350,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
            ],
            placeholder: 'Product description...',
            disableResizeEditor: true
        });
    });

    $(document).ready(function(){
        /*
        ***Remove
        */
        function remove(url, checkbox){
            var id = [];
            if(confirm("Are you sure to delete? This cannot be undo")){
                $(checkbox).each(function(){
                    id.push($(this).val());
                })

                if(id.length > 0){
                    $.ajax({
                        url: url,
                        method: 'DELETE',
                        data: {id:id},
                        dataType: 'json',
                        success: function(res){
                            if(res.status == 404){
                                toastr.warning(res.data.message);
                            }
                            if(res.status == 200){
                                product.ajax.reload();
                                toastr.success('Data Successfully Deleted');
                                $('#select-all').prop('checked', false);
                            }
                        }
                    })
                }else{
                    alert("Please select atleast one data to delete");
                }
            }
        }



        /*
        * Featured
        */
        $("#product tbody").on('change', 'td .featured', function(){
            var id = $(this).data('id');
            var val = $(this).prop('checked');

            $.ajax({
                url: "products/attributes",
                method: "PUT",
                data: {id: id, col: "f_prod",status: val},
                dataType: "json",
                success: function(res){
                    if(res.status == 200){
                        toastr.success(res.msg);
                    }
                }
            })
        })


        /*
        * Featured
        */
        $("#product tbody").on('change', 'td .best', function(){
            var id = $(this).data('id');
            var val = $(this).prop('checked');

            $.ajax({
                url: "products/attributes",
                method: "PUT",
                data: {id: id, col: "b_prod",status: val},
                dataType: "json",
                success: function(res){
                    if(res.status == 200){
                        toastr.success(res.msg);
                    }
                }
            })
        })
    });

</script>
