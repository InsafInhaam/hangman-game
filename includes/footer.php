<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    // Fetch Life Chances from Local Storage
    document.addEventListener('DOMContentLoaded', () => {
        const lifeChances = JSON.parse(localStorage.getItem('hangmanChances'))?.chances;
        document.getElementById('lifeChances').textContent = lifeChances;
    });

    function logout() {
        fetch("logout.php")
            .then(() => window.location.href = "login.php");
    }
</script>

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