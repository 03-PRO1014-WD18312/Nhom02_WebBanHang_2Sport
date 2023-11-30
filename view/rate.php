<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #header{
            display: none;
        }
        .rating {
            float: left;
            display: flex;
            flex-direction: row-reverse;
        }

        .rating input {
            display: none;
            color: #DB0000;
        }

        .rating label {
            cursor: pointer;
            width: 25px;
            height: 25px;
            background-size: cover;
        }

        .rating input:checked~label {
            color: rgb(255, 0, 0);
        }
    </style>
</head>

<body>
    <form id="ratingForm" action="" method="POST">
        <h3>Đánh giá sản phẩm </h3>
        <div class="rating">
            <input type="radio" id="star5" name="rating" value="5"><label for="star5">&#9733;</label>
            <input type="radio" id="star4" name="rating" value="4"><label for="star4">&#9733;</label>
            <input type="radio" id="star3" name="rating" value="3"><label for="star3">&#9733;</label>
            <input type="radio" id="star2" name="rating" value="2"><label for="star2">&#9733;</label>
            <input type="radio" id="star1" name="rating" value="1"><label for="star1">&#9733;</label>
        </div>
        <textarea id="" cols="30" rows="7" name="contentRate" placeholder="Nhập đánh giá của bạn"></textarea><br>
        <input type="submit" name="rateSubmit" value="Đánh giá">
    </form>
</body>

</html>
