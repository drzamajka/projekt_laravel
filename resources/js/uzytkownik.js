require('./vendor/jsvalidation/js/jsvalidation');
require('select2');
// załadowanie tłumaczeń dla języka polskiego
$.fn.select2.amd.define('select2/i18n/pl', [], require("select2/src/js/select2/i18n/pl"));


$(function () {


    $('form[name=delete-item]').on('submit', function (e) {
        e.preventDefault();
        const data = $(e.currentTarget).data();
        const message = !_.isNil(data.message) ? data.message : 'NO_MESSAGE_PROVIDED';
        const icon = !_.isNil(data.icon) ? data.icon : 'warning';
        const confirmText = !_.isNil(data.confirmText) ? data.confirmText : 'Yes';
        const confirmClass = !_.isNil(data.confirmClass) ? data.confirmClass : '';
        const cancelText = !_.isNil(data.cancelText) ? data.cancelText : 'No';
        const cancelClass = !_.isNil(data.cancelClass) ? data.cancelClass : '';

        Swal.mixin({
            customClass: {
                confirmButton: confirmClass,
                cancelButton: cancelClass
            },
            buttonsStyling: false
        }).fire({
            text: message,
            showCancelButton: true,
            confirmButtonText: confirmText,
            cancelButtonText: cancelText,
            focusCancel: true,
            icon: icon
        }).then((result) => {
            if (result.value) {
                this.submit()
            }
        });
    });


    $('#film-cover').change(function(){
            
        let reader = new FileReader();
     
        reader.onload = (e) => { 
     
          $('#film-cover-custom').attr('src', e.target.result); 
        }
     
        reader.readAsDataURL(this.files[0]); 
       
       });
});
    defaltCover = function()
    {
        document.getElementById("film-cover-custom").style.setProperty('display', 'none', 'important');
        document.getElementById("film-cover-default").style.display = "";
        document.getElementById("film-cover").style.setProperty('display', 'none', 'important');
        document.getElementById("film-cover").disabled = true;
    }
    customCover = function()
    {
        document.getElementById("film-cover-default").style.setProperty('display', 'none', 'important');
        document.getElementById("film-cover-custom").style.display = "";
        document.getElementById("film-cover").style.display = "";
        document.getElementById("film-cover").disabled = false;
    }

    

    addstar = function()
    {
        gwiazdy = document.getElementById("iloscgwiazd").value;
        if(!$.isNumeric(gwiazdy))
            gwiazdy = 1;
        console.log('gwiazdu='+gwiazdy);    
        if(gwiazdy<=5)
        {
            document.getElementById("star_nr"+gwiazdy).style.display = "";
            document.getElementById("film-star-role["+gwiazdy+"]").disabled = false;
            document.getElementById("film-star-id["+gwiazdy+"]").disabled = false;
            gwiazdy++;
            document.getElementById("iloscgwiazd").value = gwiazdy;
        }
    }
    deletestar = function(id)
    {
        gwiazdy = document.getElementById("iloscgwiazd").value;
        //gwiazdy=id+1;
        for(i=id;i<5;i++)
        {
            document.getElementById("film-star-role["+i+"]").value = 
            document.getElementById("film-star-role["+(i+1)+"]").value;
            document.getElementById("film-star-id["+i+"]").value = 
            document.getElementById("film-star-id["+(i+1)+"]").value;
        }
        if(gwiazdy>1)
        {
            gwiazdy--;
            document.getElementById("iloscgwiazd").value = gwiazdy;
            document.getElementById("star_nr"+gwiazdy).style.setProperty('display', 'none', 'important');
            document.getElementById("film-star-role["+gwiazdy+"]").value = '';
            document.getElementById("film-star-id["+gwiazdy+"]").value = '0';
            document.getElementById("film-star-role["+gwiazdy+"]").disabled = true;
            document.getElementById("film-star-id["+gwiazdy+"]").disabled = true;
        }
    }