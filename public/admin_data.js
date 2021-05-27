$(document).ready(function() {

    //fetch all data
      admin_data();

    // on click pagenation
    $(document).on("click",".pagination a",function(e){
       
        e.preventDefault();
        //call a load Data function for pagination
        admin_data($(this).attr("href"));
    });

    $(document).on('click', '.status', function(e) {
        event.preventDefault();

       admin_data($(this).attr("href"));
    });

    function admin_data(url)
    {
     

        if(typeof(url) == "undefined")
        {
            //url = "http://ci4app.infinityfreeapp.com/public/admin/dashboard/adminajax";
        }

        
        $.ajax({
            url: url,
            type: 'get',
           
            beforeSend: function() {
                $("#table_data").html("Loading....");
            },
            success: function(data) 
            {
                $("#admin_table_data").html(data);
            }
        });
    }

    
});

