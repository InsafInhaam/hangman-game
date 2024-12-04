<?php include_once './includes/header.php'; ?>
<?php include_once './includes/navbar.php'; ?>

<style>
    .language-buttons {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
    }

    .language-buttons button {
        margin: 10px;
        padding: 15px 30px;
        font-size: 18px;
        cursor: pointer;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Welcome to the Hangman Language Quiz</h1>
            <p class="text-center">Select a language to start the quiz:</p>
            <div class="language-buttons">
                <button onclick="redirectToQuiz('html')" class="btn btn-primary">HTML</button>
                <button onclick="redirectToQuiz('css')" class="btn btn-primary">CSS</button>
                <button onclick="redirectToQuiz('javascript')" class="btn btn-primary">JavaScript</button>
                <button onclick="redirectToQuiz('python')" class="btn btn-primary">Python</button>
                <button onclick="redirectToQuiz('nodejs')" class="btn btn-primary">Node.js</button>
                <button onclick="redirectToQuiz('react')" class="btn btn-primary">React</button>
                <button onclick="redirectToQuiz('laravel')" class="btn btn-primary">Laravel</button>
                <button onclick="redirectToQuiz('php')" class="btn btn-primary">PHP</button>
            </div>
        </div>
    </div>
</div>

<script>
    function redirectToQuiz(language) {
        window.location.href = `hangman.php?language=${language}`;
    }
</script>


<?php include_once './includes/footer.php'; ?>
