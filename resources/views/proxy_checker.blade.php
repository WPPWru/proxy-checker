{{-- resources/views/proxy_checker.blade.php --}}
        <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proxy Checker</title>
    <style>
        /* Здесь можно добавить CSS-стили */
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Proxy Checker</h1>
    <form id="proxyCheckerForm">
        @csrf <!-- Laravel CSRF token для безопасности -->
        <textarea name="proxies" rows="10" cols="50"
                  placeholder="Введите прокси в формате ip:port, по одному на строку"></textarea>
        <br>
        <button type="submit">Проверить прокси</button>
    </form>
    <div id="results"></div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#proxyCheckerForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '/check-proxy', // URL для отправки данных
                type: 'POST',
                data: $(this).serialize(), // Сериализация данных формы
                success: function (response) {

                    // Очистка предыдущих результатов
                    $('#results').empty();

                    // Проверка, есть ли данные в ответе
                    if (response && response.length > 0) {
                        // Создание списка для результатов
                        var resultList = $('<ul>');
                        response.forEach(function (proxy) {
                            // Добавление каждого результата в список
                            resultList.append($('<li>').text(
                                'IP: ' + proxy.ip + ', Порт: ' + proxy.port +
                                ', Статус: ' + proxy.status +
                                ', Тип: ' + proxy.type +
                                ', Местоположение: ' + proxy.location +
                                ', Скорость: ' + proxy.speed));
                        });

                        // Добавление списка в div с результатами
                        $('#results').append(resultList);
                    } else {
                        // Если данных нет, отображаем сообщение
                        $('#results').append($('<p>').text('Результаты не найдены.'));
                    }
                },

                error: function (xhr, status, error) {
                    // Обработка ошибок
                    console.error(error);
                }
            });
        });
    });
</script>

</body>
</html>
