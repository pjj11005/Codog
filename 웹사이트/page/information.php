<?php require "../header.php"; ?>

<head>
    <title>Codog prototype information</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/moonspam/NanumSquare@2.0/nanumsquare.css">
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <a href="./main.php">
        <header>
            <div class="inner">
                <img src="dog.png" />
            <h3>
                CODOG
            </h3>
            </div>
        </header>
    </a>
    <form id="myForm" onsubmit="return false">
        <!-- 정보 제출 할 링크주소 걸기 -->
        <h2>강아지 품종</h2>
        <p class="subtitle">강아지 사진을 업로드 해주세요!</p>
        <!-- 이미지 업로드  -->
        
        <input type="file" name="file" class="hidden" id="image">
        <!-- 이미지 미리보기 -->
        <div id="img-preview">
            <img src="" style="display: none;" />
            <div id="img-msg">이미지를 업로드 해주세요</div>
        </div>

        <label for="image" class="label_button">
            <div class="btn-upload">파일 업로드하기</div>
            <p id="image-name"></p>
        </label>


        <div id="result" style="margin-top:24px;"></div>
        <div id="classify" style="display:none">
            <button class="form_button" id="classify-button">품종 분류</button>
        </div>
        <div id="loading" style="display:none">
            <img src="loading.gif" />
        </div>
        <!-- 품종 분류 시 결과 입력 버튼 -->
        <div id="buts">
            <button class="form_button" id="correct-button" style="display:none">o</button>
            <button class="form_button" id="wrong-button" style="display:none">x</button>
            
        </div>
        <p id="resultMsg" ></p>
        <!-- 재시도 -->
        <div id="restart" style="display: none;">
            <form id="breed-confirmation" >
                <h2>품종이 다를 경우, 품종을 선택해 주세요:</h2>
                <select name="breed" class="form_select">
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
        </div>

        <h2 class="mb-5">강아지의 이름과 비밀번호를 등록해 주세요!</h2>
        <p>
             <input id="name" class="form_input" type="text" name="dogname" size="15" maxlength="30" style="ime-mode:active;"
                required  placeholder="강아지 이름을 등록하세요!"/>
            <span class="alert"></span>
        </p>
        <p>
            <input id="password" class="form_input" type="password" placeholder="비밀번호를 등록하세요!" name="password" size="15" maxlength="15" required />
            <span class="alert"></span>
            <button id="check-password-btn"  class="form_button">중복 확인</button> <!-- 중복 확인 버튼 추가 -->
        </p>

        <h2>카카오톡 아이디를 입력해 주세요!</h2>
        <p>
            <input class="form_input" placeholder="카카오톡 아이디를 입력해 주세요!" id="kakaoId" type="text" name="kakaoId" size="15" maxlength="30" style="ime-mode:active;" required />
            <span class="alert"></span>
            <button id="check-kakaoId-btn" class="form_button">중복 확인</button> <!-- 중복 확인 버튼 추가 -->
        </p>

        <h2>강아지의 사이즈를 골라 주세요!</h2>
        <input type="radio" class="hidden" name="size" id="small" value="small" required />
        <input type="radio" class="hidden" name="size" id="medium" value="medium" />
        <input type="radio" class="hidden" name="size" id="big" value="big" />


        <div class="label_list" id="size_ll">
            <label id="input_label_for_small" for="small">

                <img src="./img/small-dog-icon-8.jpg" class="label_img" alt="">
                <span>소형견 (~7kg)</span>
            </label>
            <label id="input_label_for_med" for="medium">

                <img src="./img/med-dog-icon-12.jpg" class="label_img" alt="">
                <span>중형견 (7~15kg)</span>
            </label>
            <label id="input_label_for_big" for="big">
                <img src="./img/big-icon-png-2.jpg" class="label_img" alt="">
                <span>대형견 (15~kg)</span>
            </label>
        </div>

        <h2>지역구를 선택해 주세요!</h2>
        <select id="place" name="place" class="form_select">
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

        <input class="hidden" id="live_1" type="radio" name="lively" value="more_outgoing" required />
        <input class="hidden" id="live_2" type="radio" name="lively" value="outgoing" />
        <input class="hidden" id="live_3" type="radio" name="lively" value="medium" />
        <input class="hidden" id="live_4" type="radio" name="lively" value="calm" />

        <div class="label_list label_list_lg label_list_lg_line">
            <label id="live_1_label" for="live_1">
                <span>매우 활발함</span>
            </label>
            <label for="live_2" id="live_2_label">
                <span>활발함</span>
            </label>
            <label for="live_3" id="live_3_label">
                <span>보통</span>
            </label>
            <label for="live_4" id="live_4_label">
                <span>조용함</span>
            </label>
        </div>

        <input class="hidden" type="radio" id="neutered1" name="neutered" value="yes" required />
        <input class="hidden" type="radio" id="neutered2" name="neutered" value="no" />

        <h2>강아지의 중성화 유무를 선택해 주세요!</h2>
        <div class="label_list label_list_sm" id="neutered_line">
            <label for="neutered1" id="neutered1_label">
                
                <img src="./img/yes.png" class="label_img label_img_sm" alt="">
                <span>예</span>
            </label>
            <label for="neutered2" id="neutered2_label">
                
                <img src="./img/no.png" class="label_img label_img_sm" alt="">
                <span>아니요</span>
            </label>
        </div>

        <h2>강아지의 성별을 골라 주세요!</h2>
        
        <input class="hidden" type="radio" name="sex" id="gender_1" value="male" required />
        <input class="hidden" type="radio" name="sex" id="gender_2" value="female" />

        <div class="label_list label_list_sm" id="gender_line">
            <label for="gender_1" id="gender_1_label">
                <img src="./img/male.png" class="label_img label_img_sm" alt="">
                <span>왕자님</span>
            </label>
            <label for="gender_2" id="gender_2_label">
                
                <img src="./img/female.png" class="label_img label_img_sm" alt="">
                <span>공주님</span>
            </label>
        </div>
        <br /><br />
        <button id="btn-submit" type="submit" class="form_button">제출</button>
    </form>

    <br /><br />
    <a href="/page/main.php" id="completion-link" class="form_button submit_button" style="display: none; text-align:center !important;">가입 완료</a>

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
        nameText.oninput = function (event) {
            if (event.target.value?.length > 15) {
                event.target.nextElementSibling.innerHTML = '이름은 15자릿수 이하만 입력가능합니다.';
            }
            if (event.target.value?.length <= 15) {
                event.target.nextElementSibling.innerHTML = '';
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
                const result = document.getElementById('result');
                result.innerHTML = '';
                // 2. 버튼 안보이게
                correctBut.style.display = 'none';
                wrongBut.style.display = 'none';
                resultMsg.innerHTML = ''
                // 3. 품종 select 박스 안보이게
                const restart = document.getElementById('restart');
                restart.style.display = 'none';

                imageElement.style.display = "block"
                imageElement.src = e.target.result;
                enableClassifyButton();

            };

            reader.readAsDataURL(file);
        }

        async function loadModel() {

            model = await tf.loadLayersModel('../tfjsmodel/model.json');
            console.log('모델', model);
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

        imageUploadInput.addEventListener('change', handleImageUpload);

        const classifyButton = document.getElementById('classify-button');
        classifyButton.addEventListener('click', () => {
            loading.style.display = 'block';
            if (!model) {
                loadModel().then(() => {
                    classifyImage();
                    wrongBut.style.display = 'inline-block'
                    correctBut.style.display = 'inline-block';
                    loading.style.display = 'none';
                });
            } else {
                classifyImage();
                wrongBut.style.display = 'inline-block'
                correctBut.style.display = 'inline-block';
                loading.style.display = 'none';
            }

        });

        correctBut.addEventListener('click', () => {
            correctBut.style.display = 'none';
            wrongBut.style.display = 'none';
            resultMsg.innerHTML = '끝'
        });

        wrongBut.addEventListener('click', () => {
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
                    if (response.result_code === "0000") {
                        fileName = response.result_msg;
                        // fileNames.push(response.result_msg);
                    } else {
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

        $(document).ready(function () {
            $('#upload_file').on('change', function (event) {
                console.log(event.target.files)
                if (event.target.files) {
                    if (event.target.files.length > 0) {
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
                const breed = correctBut.style.display === 'none' ? $('#result').text().split(':')[0] : $('select[name=breed]').val();
                const kakaoId = $('#kakaoId').val();
                console.log('breed', breed);

                if (fileName === '') {
                    alert('강아지 사진을 업로드해주세요.');
                    return;
                }

                $.ajax({
                    url: '../api/insertInformation.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        fileName: fileName,
                        name: name,
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
                        if (response.result_code === "0000") {
                            // completionLink.style.display = 'inline';
                            $('#completion-link').css('display', 'block', 'margin');
                        } else {
                            alert(response.result_msg);
                        }

                    }
                });

            });
        });

    </script>

</body>