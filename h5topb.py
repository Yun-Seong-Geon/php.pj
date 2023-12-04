from tensorflow import keras
import tensorflow_hub as hub
import os
os.environ["TFHUB_MODEL_LOAD_FORMAT"] = "UNCOMPRESSED"
with keras.utils.custom_object_scope({'KerasLayer': hub.KerasLayer}):
    model = keras.models.load_model('/Applications/XAMPP/xamppfiles/htdocs/php_pro/php.pj/frontend/ai/model.h5', compile=False)

export_path = 'frontend/ai''saved_model.pb가 저장될 디렉토리'
model.save(export_path, save_format='tf')    