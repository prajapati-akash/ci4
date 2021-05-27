$(document).ready(function() {

    //fetch all data
      data();
    
    // dropdown select on change data load
    $(".language , .currentstatus").on('change', function() {
        data();
    });

    // on click pagenation
    $(document).on("click",".pagination a",function(e){
        e.preventDefault();
        //call a load Data function for pagination
        data($(this).attr("href"));
    });

    function data(url)
    {
        var language = $(".language").val();
        var status  =  $(".currentstatus").val(); 

        csrfName = $('.csrfToken').attr('name');
        csrfHash = $('.csrfToken').val();
        
        if(typeof(url) == "undefined")
        {
            url = "http://localhost:8080/dashboard/ajaxrequest";
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: { language: language, status: status, [csrfName]: csrfHash},
            beforeSend: function() {
                $("#table_data").html("Loading....");
            },
            success: function(data) 
            {
                 $(".csrfdata").remove();
                $("#table_data").html(data);
            }
        });
    }

    $("input[type='radio']").change(function() 
    {
        if ($(this).val() == "Rejected") 
        {
            $("#reject").show();
        } 
        else 
        {
            $("#rejected").val('');
            $("#reject").hide();
        }
    })
});
