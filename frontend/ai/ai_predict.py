from fastapi import FastAPI, UploadFile, File
from tensorflow import keras
import numpy as np
import tensorflow as tf
import tensorflow_hub as hub
from PIL import Image
import io
import os
import requests
app = FastAPI()

FILE_ID = "1MN_hfzw78DVWT0JSPauIVLlzy7L4Wr2R"
MODEL_PATH = 'model.h5'
MODEL_URL = f"https://drive.google.com/uc?export=download&id={FILE_ID}"

def preprocess(image):
    image = tf.image.resize(image, [256, 256]) / 255.0
    return image


class ModelSingleton:
    _instance = None

    @classmethod
    def get_instance(cls):
        if cls._instance is None:
            cls._instance = cls._load_model()
        return cls._instance

    @classmethod
    def _load_model(cls):
        # 파일이 로컬에 없는 경우에만 다운로드합니다
        if not os.path.exists(MODEL_PATH):
            with requests.get(MODEL_URL, stream=True) as r:
                r.raise_for_status()
                with open(MODEL_PATH, 'wb') as f:
                    for chunk in r.iter_content(chunk_size=8192): 
                        f.write(chunk)
        
        model = tf.keras.models.load_model(MODEL_PATH, custom_objects={'KerasLayer': hub.KerasLayer})
        return model

@app.post("/predict/")
async def predict(file: UploadFile = File(...)):
    contents = await file.read()
    image = Image.open(io.BytesIO(contents)).convert('RGB')
    image_array = np.array(image)
    processed_image = preprocess(image_array)

    model = ModelSingleton.get_instance()  # 싱글턴 인스턴스에서 모델 가져오기
    pred = model.predict(np.array([processed_image]))
    pred_class = np.argmax(pred, axis=1)[0]

    Classes = {0: '고양이', 1: '강아지', 2: '야생동물'}
    return {"prediction": Classes[pred_class]}

