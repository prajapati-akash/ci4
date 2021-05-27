$(document).ready(function() {

    //fetch all data
      admindata();
            
    $(".status").val();
    // on click pagenation
    $(document).on("click",".pagination a",function(e){
       
        e.preventDefault();
    
        //call a load Data function for pagination
        admindata($(this).attr("href"));
    });

    // $(document).on("click", ".statusForm", function(e){
    //     e.preventDefault();
    //     var id = $(".id").val();
    //     var status = $(".status").val();
    //     if (confirm("Submitted"))
    //     {
    //         admindata($(this).attr("href"));
    //     }
    //     return false;
    // });
    
    function admindata(url)
    {
        var csrfName = $('.csrfToken').attr('name');
        var csrfHash = $('.csrfToken').val();
        

        if(typeof(url) == "undefined")
        {
            url = "http://localhost:8080/admin/dashboard/adminajax";
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: { role: status, [csrfName]: csrfHash},
            beforeSend: function() {
                $("#admin_table_data").html("Loading....");
            },
            success: function(data) 
            {
                 $(".csrfToken").remove();
                $("#admin_table_data").html(data);
            }
        });
    }
});
