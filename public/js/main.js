/**
 * Created by vdutchak on 31/03/17.
 */
$("#form").submit(function( event ) {

    // Stop form from submitting normally
    event.preventDefault();

    // Get some values from elements on the page:
    var $form = $( this ),
        name = $form.find( "input[name='name']" ).val(),
        date = $form.find( "input[name='date']" ).val(),
        status = $form.find("input[name='status']").val(),
        url = $form.attr( "action" );

    // Save the data using post
    var posting = $.ajax( {
        type: 'POST',
        url: url,
        data:
        {
            name: name,
            date: date,
            status: status
        },
        success: function(){
            window.location.href = 'all';
        },
        dataType: "json"
    });

    // Show errors
    posting.fail(function( data ) {

        for (var key in data.responseJSON) {
            var val = $form.find( "label[for='" + key + "']").text();

            alert('Пожалуйста заполните поле "' + val + '"');
        }

    });

});

//Send DELETE request according with ID of task

function deleteTask(id) {
    $.ajax({
        url: 'api/deal/' + id,
        type: 'DELETE',
        contentType: "json",
        success: function() {
            $('#' + id).fadeToggle('fast');
        }
    });

}
