const flashsuccess = $('.flash-data-success').data('flashdata');
const flashinfo = $('.flash-data-info').data('flashdata');
const flasherror = $('.flash-data-error').data('flashdata');

if(flashsuccess)
{
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: flashsuccess,
        showConfirmButton: false,
        timer: 1500
    })
}

if(flashinfo)
{
    Swal.fire({
        position: 'top-end',
        icon: 'info',
        title: flashinfo,
        showConfirmButton: false,
        timer: 1500
    })
}

if(flasherror)
{
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: flasherror,
        showConfirmButton: false,
        timer: 1500
    })
}