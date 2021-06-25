<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review page</title>
    <?php require_once("links.php")?>
    <style>
.rbox{
        border:1px solid #d1d1d1;
        padding:10px;
        width:50%;
        margin:30px auto ;
        background-color:white;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}
.input {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
}
textarea {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  background-color: #f5f5f5;
  padding: 30px;
  border-radius: 10px;
  border: 1.5px solid #d1d1d1;
  width: 150%;
  margin-bottom:20px;
  outline:none;
   
}


.stars {
  display: flex;
  padding: 0 20px;
}

.star1, .star2, .star3, .star4, .star5 {
  margin-right: 5px;
  font-size: 1.5rem;
  cursor: pointer;
}

.submit {
  color: white;
  background-color: #036bfc;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  outline: none;
  cursor: pointer;
  font-family: 'Sulphur Point', sans-serif;
  font-size: 1rem;
  transition: all .2s ease-in-out;
}
.submitbtn{
    display:flex;
    justify-content:center;
}
.submit:hover {
  background-color: #4592ff;
}

.names {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  margin-bottom: 20px;
}

.firstname, .lastname {
  width: 100%;
  padding: 10px 0 10px 10px;
  outline: none;
  border-radius: 5px;
  border: 1.5px solid #d1d1d1;
  background-color: #f5f5f5;
  font-family: 'Sulphur Point', sans-serif;
  font-size: 1rem;
}

.firstname {
  margin-right: 10px;
}

.lastname {
  margin-left: 10px;
}

    .rtitle {
    margin: 0 0 1rem 0;
    font-size: 1.5rem;
  }
  
  .rscore {
    display: flex;
    align-items: center;
    margin-bottom: 0.8rem;
    font-size: 1rem;
  }
    .score-stars {
      margin-left: 0.8rem;
    }
  .rtext {
    line-height: 1.45;
  }
  .rdeta{
      padding:15px;
  }
  .checked{
      color:orange;
  }
  @media (max-width:1080px){
    .rbox{
      width:90%;
      height:50%;
      background-attachment:fixed;
    }
    .inputbox{
      width:25%
    }
    .stars{
      flex-direction:row;
    }
  }
    </style>
</head>
<body>
    <div class="container">
        <div class="row icard">
            <div class="card col-sm-5 col-md-5 icards rdeta">
                <h4 class="rtitle">Look ma, a review title!</h4>
                <div class="rscore">
                    <span class="score">4.9</span>
                    <span>&nbsp;/&nbsp;5&nbsp;</span>
                    <span class="score-stars">⭐⭐⭐⭐⭐</span>
                </div>
                <div class="rtext">
                    <i>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo quam eveniet harum perferendis facere blanditiis molestias sit omnis, fugit, amet enim error eius aperiam dolorum autem nam voluptatibus velit. Inventore!</i>
                    <small>-John Green</small>
                </div>
            </div>
            <div class="card col-sm-5 col-md-5 icards rdeta">
                <h4 class="rtitle">Look ma, a review title!</h4>
                <div class="rscore">
                    <span class="rscore">4.9</span>
                    <span>&nbsp;/&nbsp;5&nbsp;</span>
                    <span class="score-stars">⭐⭐⭐⭐⭐</span>
                </div>
                <div class="rtext">
                    <i>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo quam eveniet harum perferendis facere blanditiis molestias sit omnis, fugit, amet enim error eius aperiam dolorum autem nam voluptatibus velit. Inventore!</i>
                    <small>-John Green</small>
                </div>
            </div>
        </div>
    </div>
    <div class=" container rbox">
    <div class="names">
      <input type="text" class="firstname" placeholder="First name">
      <input type="text" class="lastname" placeholder="Last name">
    </div>
    <div class="input">
      <div class="inputbox">
        <textarea type="text" class="reviewinp" placeholder="Write a review"></textarea>
      </div>
    
      <div class="stars">
        <div class="star1"><i class="fa fa-star checked"></i></div>
        <div class="star2"><i class="fa fa-star checked"></i></div>
        <div class="star3"><i class="fa fa-star checked"></i></div>
        <div class="star4"><i class="fa fa-star checked"></i></div>
        <div class="star5"><i class="fa fa-star "></i></div>
      </div>
      </div>
      <div class="submitbtn">
        <button class="submit">Submit Review</button>
      </div>
    
  </div>
  </div>
</div>
</body>
</html>
