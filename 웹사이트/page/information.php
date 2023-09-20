<?php require_once($_SERVER["DOCUMENT_ROOT"]."/header.php"); ?>

<head>
    <title>Codog prototype information</title>
    <style>
        .btn-upload{
            padding: 2px 2px;
            width: 136px;
            height: 29px;
            background: #fff;
            border: 1px solid rgb(77,77,77);
            border-radius: 10px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            font-size: 0.8rem;
            align-items: center;
            margin-bottom: 7px;
            justify-content: center;
            &:hover {
            background: rgb(77,77,77);
            color: #fff;
            }
        }
        #img-preview{
            display: block;
            position: relative;
            width: 300px;
            height: 300px;
        }
        #img-preview > div {
            position: absolute;
            top: 42%;
            left: 21%;
            color: #101091;
        }
        #classify{
            margin-top: 10px;
            display: flex;
        }
        #classify-button{
            width: 93px;
            height: 30px;
            background: #0078d4;
            border: none;
            border-radius: 4px;
            color: white;
        }
        #classify-button:hover{
            width: 93px;
            height: 30px;
            background: #01467b;
            border: none;
            border-radius: 4px;
            color: white;
        }
        #buts button {
            width: 47px;
            height: 30px;
            background: #d5dce2;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            margin-top: 10px;
        }
        #image{
            display: none;
        }
        body{ font-family: 'NanumSquare', sans-serif }
        [type="radio"] {
                vertical-align: middle;
                appearance: none;
                border: max(2px, 0.1em) solid gray;
                border-radius: 50%;
                width: 1.25em;
                height: 1.25em;
                transition: border 0.08s ease-in-out;
            }
            [type="radio"]:checked {
                border: 0.4em solid#041b4d;
            }
            label > span {
              position: relative;
              top: 2px;
            }
            input[type=text]{
                height: 29px;
                border: 2px solid #aaa;
                border-radius: 4px;
                margin: 8px 0;
                outline: none;
                padding: 8px;
                box-sizing: border-box;
                transition: .3s;
            }
             input[type=password]:focus{
                border-color:#041b4d;
                box-shadow:0 0 8px 0 #041b4d;
            }
            input[type=password]{
                height: 29px;
                border: 2px solid #aaa;
                border-radius: 4px;
                margin: 8px 0;
                outline: none;
                padding: 8px;
                box-sizing: border-box;
                transition: .3s;
            }
             input[type=text]:focus{
                border-color:#041b4d;
                box-shadow:0 0 8px 0 #041b4d;
            }
            #place{
                cursor: pointer;
                width: 99px;
                min-height: 36px;
                padding: 2px 2px;
                max-height: 71px;
                transition: all 300ms;
            }
            #btn-submit{
            display: block;
            font-size: 0.9rem;
            list-style-type: none;
            width: 90px;
            height: 32px;
            color: #000;
            background: #dddddd;
            text-align: center;
            border-radius: 6px;
            padding: 6px 11px;
            line-height: 26px;
            margin-right: 22px;
            margin-left: 1px;
            border: none;
            padding: 2px 2px;
            }
            #btn-submit:hover{
            background: #041b4d;
            color: #fff;
            }
            span.alert{
                color: red;
                font-weight: 600;
            }
    </style>
     <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
     <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/moonspam/NanumSquare@2.0/nanumsquare.css">   
</head>
<body>
<form id="myForm" onsubmit="return false">
    <!-- 정보 제출 할 링크주소 걸기 -->
    <h2>강아지 품종</h2>
    <p>강아지 사진을 업로드 해주세요!</p>
      <!-- 이미지 업로드  -->
    <label for="image">
        <div class="btn-upload">파일 업로드하기</div>
        <p id="image-name"></p>
    </label>
    <input type="file" name="file" id="image">
    <!-- 이미지 미리보기 -->
    <div id="img-preview">
        <img  width="300" height="300" src=""/>
        <div id="img-msg">이미지를 업로드 해주세요</div>
    </div>
    <div id="result"></div>
    <div id="classify" style="display:none">
        <button id="classify-button" disabled>품종 분류</button>
    </div>
    <div id="loading" style="display:none">
        <img src="loading.gif" style="width: 49px;margin-left: 20px;"/>
    </div>
    <!-- 품종 분류 시 결과 입력 버튼 -->
    <div id="buts">
        <button id="correct-button" style="display:none">o</button>
        <button id="wrong-button" style="display:none">x</button>
        <p id="resultMsg"></p>
    </div>
    <!-- 재시도 -->
    <div id="restart" style="display: none;">
        <form id="breed-confirmation">
            <h2>품종이 다를 경우, 품종을 선택해 주세요:</h2>
            <select name="breed">
                <option value="beagle">비글</option>
                <option value="bichon">비숑</option>
                <option value="border colie">보더콜리</option>
                <option value="bulldog">불독</option>
                <option value="chihuahua">치와와</option>
                <option value="dachshund">닥스훈트</option>
                <option value="jindo dog">진돗개</option>
                <option value="maltese">말티즈</option>
                <option value="pomeranian">포메라니안</option>
                <option value="poodle">푸들</option>
                <option value="retriever">리트리버</option>
                <option value="shiba dog">시바견</option>
                <option value="shih tzu">시츄</option>
                <option value="welsh corgi">웰시코기</option>
                <option value="yorkshire terrier">요크셔테리어</option>
                <option value="etc">기타</option>
            </select>
        </form>
    </div>    
    
    <h2>강아지의 이름과 비밀번호를 등록해 주세요!</h2>
    <p>강아지 이름 :
        <input id="name" type="text" name="dogname" size="15" maxlength="30" style="ime-mode:active;" required />
        <span class="alert"></span>
    </p>
    <p>비밀번호 :
        <input id="password" type="password" name="password" size="15" maxlength="15" required />
        <span class="alert"></span>
        <button id="check-password-btn">중복 확인</button> <!-- 중복 확인 버튼 추가 -->
    </p>

    <h2>카카오톡 아이디를 입력해 주세요!</h2>
    <p>카카오톡 아이디 :
        <input id="kakaoId" type="text" name="kakaoId" size="15" maxlength="30" style="ime-mode:active;" required />
        <span class="alert"></span>
        <button id="check-kakaoId-btn">중복 확인</button> <!-- 중복 확인 버튼 추가 -->
    </p>

    <h2>강아지의 사이즈를 골라 주세요!</h2>
    <label>
    <input type="radio" name="size" value="small" required />
    <span>소 (~7kg)</span>
    </label>
    <label>
    <input type="radio" name="size" value="medium" />
    <span>중 (7~15kg)</span>
    </label>
    <label>
    <input type="radio" name="size" value="big" />
    <span>대 (15~kg)</span>
    </label>

    <h2>지역구를 선택해 주세요!</h2>
    <select id="place" name="place">
        <option value="강남구" selected="selected">강남구</option>
        <option value="강동구">강동구</option>
        <option value="강북구">강북구</option>
        <option value="강서구">강서구</option>
        <option value="관악구">관악구</option>
        <option value="광진구">광진구</option>
        <option value="구로구">구로구</option>
        <option value="금천구">금천구</option>
        <option value="노원구">노원구</option>
        <option value="도봉구">도봉구</option>
        <option value="동대문구">동대문구</option>
        <option value="동작구">동작구</option>
        <option value="마포구">마포구</option>
        <option value="서대문구">서대문구</option>
        <option value="서초구">서초구</option>
        <option value="성동구">성동구</option>
        <option value="성북구">성북구</option>
        <option value="송파구">송파구</option>
        <option value="양천구">양천구</option>
        <option value="영등포구">영등포구</option>
        <option value="용산구">용산구</option>
        <option value="은평구">은평구</option>
        <option value="종로구">종로구</option>
        <option value="중구">중구</option>
        <option value="중랑구">중랑구</option>
    </select>

    <h2>강아지가 활발한 정도를 골라 주세요!</h2>
    <label>
    <input type="radio" name="lively" value="more_outgoing" required />
    <span>매우 활발함</span>
    </label>
    <label>
    <input type="radio" name="lively" value="outgoing" />
    <span>활발함</span>
    </label>
    <label>
    <input type="radio" name="lively" value="medium" />
    <span>보통</span>
    </label>
    <label>
    <input type="radio" name="lively" value="calm" />
    <span>조용함</span>
    </label>

    <h2>강아지의 중성화 유무를 선택해 주세요!</h2>
    <label>
    <input type="radio" name="neutered" value="yes" required />
    <span>예</span>
    </label>
    <label>
    <input type="radio" name="neutered" value="no" />
    <span>아니요</span>
    </label>

    <h2>강아지의 성별을 골라 주세요!</h2>
    <label>
    <input type="radio" name="sex" value="male" required />
    <span>왕자님</span>
    </label>
    <label>
    <input type="radio" name="sex" value="female" />
    <span>공주님</span>
    </label>
    <br /><br />
    <input id="btn-submit" type="submit" value="제출" />
</form>
<br /><br />
<a href="/page/main.html" id="completion-link" style="display: none;">가입 완료</a>

<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
<script>
    var config = {
        apiKey: "AIzaSyCzxhqJmQKs1BgXd2UMSI5hZL4VXjlcU7Q",
        authDomain: "firm-affinity-384813.firebaseapp.com",
        databaseURL: "https://firm-affinity-384813-default-rtdb.firebaseio.com",
        projectId: "firm-affinity-384813",
        storageBucket: "firm-affinity-384813.appspot.com",
        messagingSenderId: "800396532197",
        appId: "1:800396532197:web:2a92fa1c5bbec23b8db70c",
      };
      // Initialize Firebase
      firebase.initializeApp(config);

   let imageElement;
        let model;
        const correctBut = document.querySelector('#buts > #correct-button');
        const wrongBut = document.querySelector('#buts > #wrong-button');
        const resultMsg = document.getElementById('resultMsg');
        const nameText = document.getElementById('name');
        const loading = document.getElementById('loading');
        nameText.oninput = function(event){
            if(event.target.value?.length > 15){
                event.target.nextElementSibling.innerHTML ='이름은 15자릿수 이하만 입력가능합니다.';
            }
            if(event.target.value?.length <= 15){
                event.target.nextElementSibling.innerHTML ='';
            }
        }


        function handleImageUpload(event) {
            const file = event.target.files[0];
            file_frm_submit_image(file);
            
            const imageName = document.querySelector('#image-name');
            imageName.innerHTML = file.name;
            imageElement = document.querySelector('#img-preview > img');
            const reader = new FileReader();
            
            reader.onload = (e) => {
                // 이미지 올려주세요 메시지 태그
                const imgMsg = document.getElementById('img-msg');
                imgMsg.style.display = 'none';

                // 품종 분류 
                const classify = document.getElementById('classify');
                classify.style.display = 'block';

                // 재 이미지 등록시 리셋 기능
                // 1. 결과 이미 출력 -> 리셋
                const result =document.getElementById('result');
                result.innerHTML = '';
                // 2. 버튼 안보이게
                correctBut.style.display = 'none';
                wrongBut.style.display = 'none';
                resultMsg.innerHTML = ''
                // 3. 품종 select 박스 안보이게
                const restart = document.getElementById('restart');
                restart.style.display='none';

                imageElement.src = e.target.result;
                enableClassifyButton();
                
            };

            reader.readAsDataURL(file);
        }
     
        async function loadModel() {

            model = await tf.loadLayersModel('../tfjsmodel/model.json');
            console.log('모델',model);
        }

        async function classifyImage() {
            const resizedImage = tf.image.resizeBilinear(tf.browser.fromPixels(imageElement), [224, 224]);
            const expandedImage = resizedImage.expandDims(0);
            const preprocessedImage = expandedImage.div(255.0);

            const predictions = model.predict(preprocessedImage);

            const resultElement = document.getElementById('result');
            resultElement.innerHTML = '';

            const topPredictions = Array.from(predictions.dataSync())
                .map((prob, index) => ({ probability: prob, className: index }))
                .sort((a, b) => b.probability - a.probability)
                .slice(0, 1);
            const labels = ['Beagle', 'Bichon', 'Border collie', 'Bulldog', 'Chihuahua', 'Dachshund',
            'Jindo dog', 'Maltese', 'Pomeranian', 'Poodle', 'Retriever', 'Shiba dog',
            'Shih Tzu', 'Welsh corgi', 'Yorkshire terrier', 'etc'];

            topPredictions.forEach((prediction) => {
                const { className, probability } = prediction;
                const label = labels[className];
                const probabilityPercentage = Math.floor(probability * 100);
                const predictionText = `${label}: ${probabilityPercentage}%`;
                const predictionElement = document.createElement('p');
                predictionElement.innerText = predictionText;
                resultElement.appendChild(predictionElement);
            });
        }

        function enableClassifyButton() {
            const classifyButton = document.getElementById('classify-button');
            classifyButton.disabled = false;
        }

        const imageUploadInput = document.getElementById('image');
        
        imageUploadInput.addEventListener('change',handleImageUpload);

        const classifyButton = document.getElementById('classify-button');
        classifyButton.addEventListener('click', () => {
            loading.style.display ='block';
            if (!model) {
                loadModel().then(() => {
                    classifyImage();
                    wrongBut.style.display='inline-block'
                    correctBut.style.display='inline-block';
                    loading.style.display ='none';
                });
            } else {
                classifyImage();
                 wrongBut.style.display='inline-block'
                 correctBut.style.display='inline-block';
                loading.style.display ='none';
            }

        });

        correctBut.addEventListener('click',()=>{
            correctBut.style.display ='none';
            wrongBut.style.display = 'none';
            resultMsg.innerHTML ='끝'
        });

        wrongBut.addEventListener('click',()=>{
            const restart = document.getElementById('restart');
            restart.style.display = 'block';
        });

    


    // var form = document.querySelector('');
    // let completionLink = document.getElementById('completion-link');
    let fileName = '';

    function file_frm_submit_image(file) {

        if (!file) {
            alert("업로드할 파일을 선택하세요.");
            return false;
        }
        let formData = new FormData();			// 파일전송을 위한 폼데이터 객체 생성
        formData.append("upload_file", file);		// formdata 객체에 파일 추가

        $.ajax({
            url: '../api/ajax_file_upload.php',
            data: formData,
            type: 'POST',
            dataType: 'json',
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            async: true,
            success: function (response) {
                console.log("//123")
                console.log(JSON.stringify(response));
                if(response.result_code === "0000") {
                    fileName = response.result_msg;
                    // fileNames.push(response.result_msg);
                }else {
                    alert(response.result_msg);
                }

            },
            error: function (err) {
                console.log("//err", JSON.stringify(err));
            }
        });
    }


    // 중복된 비밀번호가 있는지 확인하는 함수
    function checkDuplicatePassword(password) {
        var ref = firebase.database().ref("posts");
        return ref
            .orderByChild("password")
            .equalTo(password)
            .once("value")
            .then(function (snapshot) {
                return snapshot.exists();
            });
    }

    // 중복된 카카오톡 아이디가 있는지 확인하는 함수
    function checkDuplicatekakaoId(kakaoId) {
        var ref = firebase.database().ref("posts");
        return ref
            .orderByChild("kakaoId")
            .equalTo(kakaoId)
            .once("value")
            .then(function (snapshot) {
                return snapshot.exists();
            });
    }

    $(document).ready(function() {
        $('#upload_file').on('change', function (event) {
            console.log(event.target.files)
            if (event.target.files){
                if (event.target.files.length > 0){
                    const file = event.target.files[0];
                    file_frm_submit_image(file)
                }
            }
        })

        // 중복 확인 버튼 클릭 이벤트 처리
        $('#check-password-btn').on('click', function () {
            const password = $('#password').val();
            
            // 입력된 비밀번호가 빈칸이면 알림 표시
            if (!password) {
                alert("비밀번호를 입력하세요.");
                return;
            }

            // 중복된 비밀번호가 있는지 확인
            checkDuplicatePassword(password).then(function (isDuplicate) {
                if (isDuplicate) {
                    alert("이미 사용 중인 비밀번호입니다.");
                } else {
                    alert("사용 가능한 비밀번호입니다.");
                }
            });
        });

        $('#check-kakaoId-btn').on('click', function () {
            const kakaoId = $('#kakaoId').val();
            
            // 입력된 비밀번호가 빈칸이면 알림 표시
            if (!kakaoId) {
                alert("카카오톡 아이디를 입력하세요.");
                return;
            }

            // 중복된 비밀번호가 있는지 확인
            checkDuplicatekakaoId(kakaoId).then(function (isDuplicate) {
                if (isDuplicate) {
                    alert("이미 사용 중인 카카오톡아이디입니다.");
                } else {
                    alert("사용 가능한 카카오톡아이디입니다.");
                }
            });
        });

        $('#btn-submit').on('click', function (event) {
            event.preventDefault(); // 폼 제출 동작 중지

            const name = $('#name').val();
            const password = $('#password').val();
            const size = $('input[name=size]:checked').val()
            const place = $('#place').val();
            const lively = $('input[name=lively]:checked').val();
            const neutered = $('input[name=neutered]:checked').val();
            const sex = $('input[name=sex]:checked').val();
            const breed = correctBut.style.display==='none' ?  $('#result').text().split(':')[0] : $('select[name=breed]').val();
            const kakaoId = $('#kakaoId').val();
            console.log('breed',breed);
           
            if(fileName === '') {
                alert('강아지 사진을 업로드해주세요.');
                return;
            }

            $.ajax({
                url: '../api/insertInformation.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    fileName: fileName,
                    name : name,
                    password: password,
                    size: size,
                    place: place,
                    lively: lively,
                    neutered: neutered,
                    sex: sex,
                    breed: breed,
                    kakaoId: kakaoId
                },
                async: false,
                success: function (response) {
                    console.log(response)
                    if(response.result_code === "0000") {
                        // completionLink.style.display = 'inline';
                        $('#completion-link').css('display', 'inline');
                    }else {
                        alert(response.result_msg);
                    }

                }
            });

        });
    });

</script>

</body>