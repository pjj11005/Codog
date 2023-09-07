# 2023년 캡스톤 설계 프로젝트
Codog - Dog Friend Matching Website 

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

1. Data
    - Total of 4800 images (300 per breed)
    - Labels: 16 categories

    ![project sitemap](/image/label.png)

    - etc: Pug, Afghan Hound, Samoyed, Shepherd, Siberian Husky → Composed of 5 breeds, each with 60 images.

2. 데이터 수집

    - 크롤링 데이터 (40%) + Tsinghua Dogs 데이터셋 (40%) + kaggle 데이터 (20%) 이용하여  데이터 수집

    - Tsinghua Dogs 데이터셋: [https://cg.cs.tsinghua.edu.cn/ThuDogs/](https://cg.cs.tsinghua.edu.cn/ThuDogs/)

    - kaggle 데이터: [https://www.kaggle.com/competitions/dog-breed-identification/data](https://www.kaggle.com/competitions/dog-breed-identification/data)


3. 모델 성능 향상
    >기본 베이스 라인 모델 학습 결과 -> val_loss, val_accuracy가 매우 낮게 나와 모델의 성능을 높이기로 결정

    - 데이터 증강: 회전각도, 확대축소, 좌우이동, 상하이동, 좌우반전 등 5~7가지 데이터 증강 기법을 사용해서 Train과 Val 데이터에 적용

    - 전이학습: 13개의 전이학습 모델들을 가져와 학습에 사용

    - 가장 좋은 성능과 시간도 적게 드는 Xception 모델로 선정

4. 모델 성능 확인
    - 
### 2. Implementation of Website Login
