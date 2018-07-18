  <script type="text/javascript">
        $(document).on("ready", function () {
        $("select").material_select();
        $("#expertise").tagit({
          caseSensitive : false,
        allowDuplicates : false,
        allowSpaces:true,
        tagLimit:10,
        onTagExists: function(event, ui) {
          toastr.options.timeOut = 5000;
          toastr.options.positionClass = "toast-bottom-right";
          toastr.warning('Duplicate keywords not allowed');
        },
        onTagLimitExceeded: function(event, ui) {
          toastr.options.timeOut = 5000;
          toastr.options.positionClass = "toast-bottom-right";
          toastr.warning('Maximum 10 keywords allow');
        }
        });

            $(".fa-eye").on("mouseenter",function(){
              $("#password").attr("type","text");
            });
            $(".fa-eye").on("mouseleave",function(){
              $("#password").attr("type","password");
            });

        
        $("#btnSubmit").on("click", function(){
          $.post(site_url+'user/create_resource', $("#formAddResource").serialize(), function(response) {
                    if(parseInt(response) > 0)
                    {
                         toastr.options.timeOut = 5000;
                         toastr.options.positionClass = "toast-up-right";
                         $("#formAddResource").html("<h5 class='red-text'>Updating Database....</h5>");
                         toastr.success('Resource updated successfully!');
                         setInterval(function(){ window.location = site_url+'user/view_resources'; }, 2000);
                    }
                    else{
                         toastr.options.timeOut = 5000;
                         toastr.options.positionClass = "toast-up-right";
                         toastr.warning('Sorry! No reource updated.'); 
                    }
                 });
            return false;
        });

      });

      </script>