$(document).ready(function(){
        $('registration').on('click',function(event){
            event.preventDefault;
            let dataFields = $('#form_creation').val().trim();
            function validate(){
            if(dataFields == ''){
                alert("Please fill all form fields");
            }
        }
        });
});
