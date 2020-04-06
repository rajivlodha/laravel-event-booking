
$(document).ready(function($)
{
    $("#event_id").change(function()
    {
        $.get("{{ url('/bookingdetail')}}",
        { option: $(this).val() },
        function(data) 
        {
            $('#stallid').empty();
            $.each(data, function(key, element) 
            {
                $('#stallid').append("" + element + "");
            });
        }); 
    });
});
