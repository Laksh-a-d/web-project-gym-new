<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Achievements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('C:/xampp/htdocs/xampp/htdocs/demo/anup/Gym-Logo.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-color: rgba(200, 200, 200, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        main {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .achievements {
            display: flex;
            transition: transform 0.5s ease;
        }

        .achievement {
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px;
            width: 100%;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .achievement h2 {
            margin-top: 0;
            font-size: 32px;
            color: #333;
        }

        .achievement p {
            margin-bottom: 10px;
            color: #666;
        }

        .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #333;
            font-size: 24px;
            background: none;
            border: none;
            outline: none;
            z-index: 1;
        }

        .arrow.prev {
            left: 10px;
        }

        .arrow.next {
            right: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Gym Achievements</h1>
    </header>
    <main>
        <div class="achievements">
            <section class="achievement">
                <h2>Weightlifting Champ</h2>
                <p>Deadlift: 500 lbs</p>
                <p>Squat: 450 lbs</p>
                <p>Bench Press: 400 lbs</p>
            </section>
            <section class="achievement">
                <h2>Marathon Runner</h2>
                <p>Completed 5 marathons</p>
                <p>Fastest time: 3:30:00</p>
            </section>
            <section class="achievement">
                <h2>Bodybuilding Pro</h2>
                <p>Won Mr./Ms. Gym competition</p>
                <p>Body fat percentage: 5%</p>
            </section>
        </div>
        <button class="arrow prev" onclick="prevAchievement()">&#10094;</button>
        <button class="arrow next" onclick="nextAchievement()">&#10095;</button>
    </main>
    <footer>
        <p>&copy; 2024 Gym Achievements</p>
    </footer>

    <script>
        let currentIndex = 0;
        const achievements = document.querySelector('.achievements');
        const achievementWidth = document.querySelector('.achievement').offsetWidth;

        function showAchievement(index) {
            achievements.style.transform = `translateX(-${index * achievementWidth}px)`;
            currentIndex = index;
        }

        function nextAchievement() {
            if (currentIndex < achievements.children.length - 1) {
                currentIndex++;
                showAchievement(currentIndex);
            }
        }

        function prevAchievement() {
            if (currentIndex > 0) {
                currentIndex--;
                showAchievement(currentIndex);
            }
        }

        // Automatically change slides every 3 seconds
        setInterval(() => {
            nextAchievement();
        }, 3000);
    </script>
</body>
</html>
