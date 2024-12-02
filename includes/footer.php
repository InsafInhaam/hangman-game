<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        function fetchScore() {
            $.ajax({
                url: TEMPERDIR + 'function/get_score.php',
                method: "GET",
                dataType: 'json',
                success: function (response) {
                    if (response.score !== undefined) {
                        $('#score').text(response.score);
                    }
                },
                error: function () {
                    console.error('Failed to fetch the score')
                }
            })
        }

        fetchScore();

        setInterval(fetchScore, 5000)
    })
</script>
</body>

</html>