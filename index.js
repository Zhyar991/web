fetchData();

function fetchData()
{
    $.ajax({
        url: "fetchData.php",
        type: "GET",
        success: function(response)
        {
            var myData = JSON.parse(response);
            var tmp= '';

            if(myData["status"] == "failed")
            {
                alert("failed");
            }
            else
            {
                $.each(myData, function(){
                    tmp += 
                    `
                    <tr>
                        <td>${this["id"]}</td>
                        <td><img src="photos/${this["car_image"]}" width="100" height="70" ></td>
                        <td>${this["brand"]}</td>
                        <td>${this["model"]}</td>
                        <td>${this["year"]}</td>
                        <td>${this["condition"]}</td>
                        <td><button onclick="passData(${this["id"]});" class="btn btn-warning" data-toggle="modal" data-target="#updateDataModal">Update</button></td>
                        <td><button onclick="removeData(${this["id"]});" class="btn btn-danger">Remove</button></td>
                    </tr>
                    `
                });
                $('#tbody').html(tmp);
            }
        },
        error: function(error)
        {
            console.log(error);
        }
    });
}


$('#addDataForm').on('submit', function(event){
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: "addData.php",
        type: "post",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response)
        {
            var myData = JSON.parse(response);

            if(myData["status"] == "added")
            {
                $('#addDataModal').modal('hide');
                fetchData();
            }
            else
            {
                alert("failed");
            }
        },
        error: function(error)
        {
            console.log(error);
        }
    });
});

function removeData(id)
{
    $.ajax({
        url: "removeData.php",
        type: "GET",
        data: {"id":id},
        success: function(response)
        {
            var myData = JSON.parse(response);

            if(myData["status"] == "removed")
            {
                fetchData();
            }
            else
            {
                alert("failed");
            }
        },
        error: function(error)
        {
            console.log(error);
        }
    });
}

function passData(id)
{
    $.ajax({
        url: "passData.php",
        type: "GET",
        data: {"id":id},
        success: function(response)
        {
            var myData = JSON.parse(response);
            $('#update-brand').val(myData[0]["brand"]);
            $('#update-model').val(myData[0]["model"]);
            $('#update-year').val(myData[0]["year"]);
            $('#update-condition').val(myData[0]["condition"]);

            $('#updateDataForm').on('submit', function(event){
                event.preventDefault();

                var formData = new FormData(this);
                formData.append('id', myData[0]["id"]);

                updateData(formData);
                
            });
            

        },
        error: function(error)
        {
            console.log(error);
        }
    });
}

function updateData(formData)
{
    $.ajax({
        url: "updateData.php",
        type: "post",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response)
        {
            var myData = JSON.parse(response);

            if(myData["status"] == "updated")
            {
                $('#updateDataModal').modal('hide');
                fetchData();
            }
        },
        error: function(error)
        {
            console.log(error);
        }
    });
}