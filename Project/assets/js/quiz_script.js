document.addEventListener('DOMContentLoaded', function ()
{
    let timeLeft = 15;
    const timerElement = document.getElementById('timer');

    function updateTimer()
    {
        if (timeLeft <= 0)
        {
            document.getElementById('quiz-form').submit();
        }
        else
        {
            timerElement.textContent = 'Remaining time: ' + timeLeft + ' seconds';
            timeLeft--;
        }
    }

    setInterval(updateTimer, 1000);
});