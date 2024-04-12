import os
import cv2
import numpy as np
from keras.models import load_model
import matplotlib.pyplot as plt
import sys
import mysql.connector

# a, b = sys.argv[1], sys.argv[2]   # 接收位置参数
# print(int(a)+int(b))


# Function to load and preprocess images
def load_images_from_folder(folder):
    images = []
    for filename in os.listdir(folder):
        img = cv2.imread(os.path.join(folder, filename))
        if img is not None:
            img = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
            img = cv2.resize(img, (48, 48))  # Resize to a fixed size for the model
            images.append(img)
    return images

# Load the saved model
loaded_model = load_model("model/facial_expression_model.h5")

# Load a custom test image
#######################################
# custom_test_image_path = "img/01.jpg"
custom_test_image_path = 'process/image.jpg'
#######################################

try:
    custom_test_image = cv2.imread(custom_test_image_path)
    if custom_test_image is not None:
        custom_test_image = cv2.cvtColor(custom_test_image, cv2.COLOR_BGR2GRAY)
        custom_test_image = cv2.resize(custom_test_image, (48, 48))
        custom_test_image = custom_test_image.astype('float32') / 255.0

        # Reshape the image to match the model input shape
        custom_test_image = np.expand_dims(custom_test_image, axis=0)
        custom_test_image = np.expand_dims(custom_test_image, axis=-1)

        # Make predictions on the custom test image
        prediction = loaded_model.predict(custom_test_image)
        prediction_prob = prediction[0]

        emotion_label = np.argmax(prediction[0])

        # Map the predicted label to emotion class
        emotion_classes = {0: 'happy', 1: 'sad', 2: 'angry'}
        predicted_emotion = emotion_classes[emotion_label]    ###output

        # Print the custom test image and its predicted label
        print(f"\nPredicted Emotion: {predicted_emotion}")
        print(f"Confidence [happy, sad, angry]: {prediction_prob}")

        # # Display the custom test image using matplotlib
        # plt.imshow(custom_test_image[0, :, :, 0], cmap='gray')
        # plt.title(f"Predicted Emotion: {predicted_emotion}")
        # plt.axis('off')  # Hide axes
        # plt.show()

        # 连接到数据库
        cnx = mysql.connector.connect(user='root', password='', host='localhost', database='4007')
        cursor = cnx.cursor()

        # 获取当前最大的 mood_record_no
        select_max_record_no_query = "SELECT MAX(mood_record_no) FROM mood"
        cursor.execute(select_max_record_no_query)
        max_record_no = cursor.fetchone()[0]

        # 更新 mood_type
        update_mood_type_query = "UPDATE mood SET mood_type = %s WHERE mood_record_no = %s"
        cursor.execute(update_mood_type_query, (predicted_emotion, max_record_no))
        cnx.commit()

        # 关闭数据库连接
        cursor.close()
        cnx.close()

    else:
        print("Failed to load the custom test image.")
except Exception as e:
    print(f"An error occurred while processing the custom test image: {str(e)}")