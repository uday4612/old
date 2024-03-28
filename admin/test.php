<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Suggestions</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h2>Train Suggestions</h2>
    <label for="train_number">Train Number:</label>
    <input type="text" id="train_number" name="train_number" required><br><br>
    
    <label for="train_name">Train Name:</label>
    <input type="text" id="train_name" name="train_name" required><br><br>

    

    <script>
        $(document).ready(function(){
            // Function to fetch train suggestions
            function fetchSuggestions(input, callback){
                $.ajax({
                    url: 'fetch_train_suggestions.php',
                    type: 'GET',
                    data: { search_term: input },
                    dataType: 'json',
                    success: function(response){
                        callback(response);
                    }
                });
            }

            // Event listener for train number input field
            $('#train_number').on('input', function(){
                var input = $(this).val();
                fetchSuggestions(input, function(suggestions){
                    displaySuggestions(suggestions);
                });
            });

            // Event listener for train name input field
            $('#train_name').on('input', function(){
                var input = $(this).val();
                fetchSuggestions(input, function(suggestions){
                    displaySuggestions(suggestions);
                });
            });

            // Function to display suggestions
            function displaySuggestions(suggestions){
                var suggestionHTML = '';
                suggestions.forEach(function(suggestion){
                    suggestionHTML += '<p>Train Number: ' + suggestion.train_number + ', Train Name: ' + suggestion.train_name + '</p>';
                });
                $('#suggestions').html(suggestionHTML);
            }
        });
    </script>
    <div>This is suggestion: </div>
    <div id="suggestions"></div>
</body>
</html>
