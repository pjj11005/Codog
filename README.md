# 2023년 1학기 캡스톤 설계 프로젝트
Codog - Dog Friend Matching Website \
[https://codog.co.kr/]

## Project Overview

> A project that helps users find dogs that match their preferences through a world cup-style competition based on user-defined criteria.

### Reasons for Development
1. Service Gap: There is a lack of matchmaking services specifically for dogs.

2. Increasing Pet Owners: The demand for pets and the subsequent demand for related services are on the rise.

3. Safety: Does not require personal information from pet owners.

## Project Sitemap
![project sitemap](/image/sitemap.png)

## Project Implementation Features

### 1. Implementation of Image Deep Learning Model

**1. Data**
- Total of 4800 images (300 per breed)
- Labels: 16 categories
- etc: Pug, Afghan Hound, Samoyed, Shepherd, Siberian Husky → Composed of 5 breeds, each with 60 images.

    ![project sitemap](/image/label.png)

**2. Data Collection:**

- Data Sources: Data collection involves using web crawling data (40%), Tsinghua Dogs dataset (40%), and Kaggle dataset (20%).
- Tsinghua Dogs Dataset: [https://cg.cs.tsinghua.edu.cn/ThuDogs/](https://cg.cs.tsinghua.edu.cn/ThuDogs/)
- Kaggle Dataset: [https://www.kaggle.com/competitions/dog-breed-identification/data](https://www.kaggle.com/competitions/dog-breed-identification/data)

**3. Model Performance Enhancement:**

   >Baseline model training results showed very low val_accuracy(20~30%), prompting the decision to improve model performance.

- Data Augmentation: Apply 5-7 data augmentation techniques such as rotation, zooming, horizontal and vertical shifts, and horizontal flipping to both the training and validation datasets.
- Transfer Learning: Utilize 13 different transfer learning models for training, ultimately selecting the MobileNetV2 model for its superior performance and efficiency.

    ![Transfer Learning Result](/image/transferlearning.png)

**4. Model Performance Evaluation**
- MobileNetV2 Model Training Results (5 Epochs): The model achieved a validation accuracy of approximately 92.5% and a validation loss of approximately 0.3

- Overall Model Accuracy: 94.17%

    ![accuracy&loss](/image/accuracy&loss.png)

    ![modelaccuracy](/image/modelaccuracy.png)

- Precision and Recall: The model exhibited high precision and recall for most classes, resulting in an overall high accuracy. However, the Recall values for the Beagle and Maltese classes were relatively lower.

    ![precision&recall](/image/precision&recall.png)

- Confusion Matrix: The confusion matrix, represented as a heatmap, shows that the model's predictions align well with the actual classes, as indicated by the predominantly dark colors.

    ![confusionmatrix](/image/confusionmatrix.png)

- Model Predictions: The model performs exceptionally well in predicting a wide range of 4,800 images.

    ![modelprediction](/image/modelprediction.png)
    
### 2. Implementation of Website Login

- 품종 분류: TensorFlow.js로 변환시킨 학습된 모델 사용, 품종 예측 유무에 따라 품종 선택 가능
- 패스워드: 가입 시 강아지 이름은 중복 가능성이 있으므로 패스워드 중복 불가능 처리
- 로그인 구현: 비 로그인 시 매칭 불가능, 가입 시 입력한 강아지 이름 및 패스워드를 통해 로그인

    ![breedclassification](/image/breedclassification.png)

## 배운점 및 아쉬운점

- 모델 학습 시 random state를 조절하여 val loss와 accuracy를 효과적으로 수렴시킬 수 있음을 배웠음
- 데이터 수집 부족으로 모델의 성능 향상이 제한되어 아쉬웠음
- 개와 고양이 두 가지 범주를 대상으로 한다면 서비스의 범용성이 더 넓어졌을 것으로 예상됨
- 다양한 모델들을 전이 학습에 활용하면서 각 모델의 특성을 학습하고 활용할 수 있었음

## 팀원

- 지승찬 - 팀장, 서버 관리, 일정 관리 (광운대학교 정보융합학부 데이터사이언스전공)
- 정호빈 - 매칭 알고리즘 구현, 발표 (광운대학교 정보융합학부 데이터사이언스전공)