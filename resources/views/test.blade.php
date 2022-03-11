<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tags</title>
    <style>
        .tag {
            background: #888;
            color: #fff;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: context-menu;
            margin-right: 5px;
        }
        .hide {
            display: none;
        }
    </style>
</head>
<body>
    <form>
        <select>
            <option disabled>Select a city</option>>
            <option value="one">Number one</option>
            <option value="two">Number two</option>
            <option value="three">Number three</option>
        </select>
        <br><br><br>
        <div class="result">

        </div>
    </form>
    <script>
        document.querySelector('select').addEventListener('input', e => {
            let option = e.target.options[e.target.selectedIndex];
            let spanTag = document.createElement('span');
            let textTag = document.createTextNode(option.text);
            spanTag.addEventListener('click', function() {
                this.remove();
                option.classList.remove('hide');
            });
            spanTag.classList.add('tag');
            spanTag.append(textTag);
            document.querySelector('.result').append(spanTag);

            option.classList.add('hide');

            e.target.options[0].selected=true
            
        })
    </script>
</body>
</html>