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

    ![Transfer Learning Result](/image/accuracy&loss.png)

    ![Transfer Learning Result](/image/modelaccuracy.png)

- Precision and Recall: The model exhibited high precision and recall for most classes, resulting in an overall high accuracy. However, the Recall values for the Beagle and Maltese classes were relatively lower.

    ![Transfer Learning Result](/image/precision&recall.png)

- Confusion Matrix: The confusion matrix, represented as a heatmap, shows that the model's predictions align well with the actual classes, as indicated by the predominantly dark colors.

    ![Transfer Learning Result](/image/confusionmatrix.png)

- Model Predictions: The model performs exceptionally well in predicting a wide range of 4,800 images.

    ![Transfer Learning Result](/image/modelprediction.png)
    
### 2. Implementation of Website Login

