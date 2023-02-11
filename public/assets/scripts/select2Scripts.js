 $(document).ready(function() {
        $('#test_id').select2({
           ajax : {
              url: "api/getCheckup.php",
              type : "post" ,
              dataType : "json",
              data : function (params) {
                 return {
                    search : params.term
                 };
              } ,
              processResults: function (response) {
                
                return{
                  results : response
                };
              },
              cache: true
            }
        });

        $('#ref_id').select2({
           ajax : {
              url: "api/getRefs.php",
              type : "post" ,
              dataType : "json",
              data : function (params) {
                 return {
                    search : params.term
                 };
              } ,
              processResults: function (response) {
                
                return{
                  results : response
                };
              },
              cache: true
            }
        });

        $('#unit_id').select2({
           ajax : {
              url: "api/getUnits.php",
              type : "post" ,
              dataType : "json",
              data : function (params) {
                 return {
                    search : params.term
                 };
              } ,
              processResults: function (response) {
                
                return{
                  results : response
                };
              },
              cache: true
            }
        });

        $('#request_test').select2({
           ajax : {
              url: "api/getRequestedCheckup.php",
              type : "post" ,
              dataType : "json",
              data : function (params) {
                 return {
                    search : params.term
                 };
              } ,
              processResults: function (response) {
                
                return{
                  results : response
                };
              },
              cache: true
            }
        });

        $('#patient_name').select2({
           ajax : {
              url: "api/getPatients.php",
              type : "post" ,
              dataType : "json",
              data : function (params) {
                 return {
                    search : params.term
                 };
              } ,
              processResults: function (response) {
                
                return{
                  results : response
                };
              },
              cache: true
            }
        });




        
    });