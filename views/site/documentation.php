<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 06.05.2019
 * Time: 16:07
 */
use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Documentation';
?>
<div class="content-docs">
    <div id="api_client" class="link">
        <h1 class="title">
            API client
        </h1>
        <p>
            Our system works with the <span>gRPC service</span> developed by Google. It allows data transferring to the server quickly and safely, with no need to worry if someone intercepts your requests. You can read more about the gRPC service on the official website: <a href="grpc.io">grpc.io</a>

            Before using the API, you have to register and create a new key, or download a free trial key in case you want to test the service. You can choose as many modules as you want.
            <br><br>
<!--            Show setup for: Ubuntu: 16 <span class="round_gradient">18</span> + Python: 2,7 <span class="round_gradient">3,7</span>-->
<!--        </p>-->
<!--    </div>-->
<!--    <div id="installation" class="link">-->
<!--        <h2>Installation</h2>-->
<!--        <p>1. First, you have to install the requirements and the system core:</p>-->
<!--        <ul class="steps">-->
<!--            <li>-->
<!--                1.1 Clone the GitHub repository:-->
<!--                <br />-->
<!--                <pre><code>git clone https://github.com/NeurodataLab/api-service</code></pre>-->
<!--            </li>-->
<!--            <li>-->
<!--                1.2 Go to the Python folder:-->
<!--                <br />-->
<!--                <pre><code>cd api-service/python</code></pre>-->
<!--            </li>-->
<!--            <li>-->
<!--                1.3 Install requirements:-->
<!--                <br />-->
<!--                <pre><code>python2 [python3] -m pip install -r -requirements.txt</code></pre>-->
<!--            </li>-->
<!--            <li>-->
<!--                1.4 Create proto files for the gRPC:-->
<!--                <br />-->
<!--                <pre><code>source ./make_proto_python2.sh [make_proto_python3.sh]</code></pre>-->
<!--                <br />-->
<!--                1.5 All generated files will be placed into <br />-->
<!--                <pre><code>api-service/python/pyproto</code></pre>-->
<!--            </li>-->
<!--        </ul>-->
<!--        <p>-->
<!--            2. After successful installation you will have to add the keys to the system:-->
<!--        </p>-->
<!--        <ul class="steps">-->
<!--            <li>-->
<!--                2.1 Download each key from your personal account. There will be 4 files. Read more about them at <a href="grpc.io">grpc.io</a>-->
<!--            </li>-->
<!--            <li>-->
<!--                2.2 Create a subfolder under-->
<!--                <pre><code>api-service/cert</code></pre>-->
<!--                with any name you want, for example my_key-->
<!--            </li>-->
<!--            <li>-->
<!--                2.3 Put the 4 files to this subfolder-->
<!--                <pre><code>api-service/cert/my_key/</code></pre>-->
<!--            </li>-->
<!--        </ul>-->
<!--    </div>-->
<!--    <div id="usage" class="link">-->
<!--        <h2>Usage</h2>-->
<!--        <p>-->
<!--            Before use, don’t forget to add api-service/python and api-service/python/pyproto to PYTHONPATH environment variable.-->
<!--            Show setup for:-->
<!--            <input name="setup_for" type="radio" value="ubu" id="ubuntu" checked>-->
<!--            <label for="ubuntu">-->
<!--                Ubuntu: 16 <span class="round_gradient">18</span>-->
<!--            </label>-->
<!--            -->
<!--            <input name="setup_for" type="radio" value="pyt" id="python">-->
<!--            <label for="python">-->
<!--                Python: 2.7 <span class="round_gradient">3.7</span>-->
<!--            </label>-->
<!--            First, you will have to authorize in the service:-->
<!--        </p>-->
<!--        <pre><code><span class="pink">import</span> api.auth.Auth <span class="pink">as</span> Auth-->


        </p>
        <div id="installation">
            <h2>Installation</h2>
            <p>1. First, you have to install the requirements and the system core:</p>
            <ul class="steps">
                <li>
                    1.1 Clone the GitHub repository:
                    <br />
                    <pre><code>git clone https://github.com/NeurodataLab/api-service</code></pre>
                </li>
                <li>
                    1.2 Go to the Python folder:
                    <br />
                    <pre><code>cd api-service/python</code></pre>
                </li>
                <li>
                    1.3 Install requirements:
                    <br />
                    <pre><code>python2 [python3] -m pip install -r -requirements.txt</code></pre>
                </li>
                <li>
                    1.4 Create proto files for the gRPC:
                    <br />
                    <pre><code>source ./make_proto_python2.sh [make_proto_python3.sh]</code></pre>
                    <br />
                    1.5 All generated files will be placed into <br />
                    <pre><code>api-service/python/pyproto</code></pre>
                </li>
            </ul>
            <p>
                2. After successful installation you will have to add the keys to the system:
            </p>
            <ul class="steps">
                <li>
                    2.1 Download each key from your personal account. There will be 4 files. Read more about them at <a href="grpc.io">grpc.io</a>
                </li>
                <li>
                    2.2 Create a subfolder under
                    <pre><code>api-service/cert</code></pre>
                    with any name you want, for example my_key
                </li>
                <li>
                    2.3 Put the 4 files to this subfolder
                    <pre><code>api-service/cert/my_key/</code></pre>
                </li>
            </ul>
        </div>
        <div id="usage">
            <h2>Usage</h2>
            <p>
                Before use, don’t forget to add api-service/python and api-service/python/pyproto to PYTHONPATH environment variable.
                First, you will have to authorize in the service:
            </p>
            <pre><code><span class="pink">import</span> api.auth.Auth <span class="pink">as</span> Auth
<span class="pink">import</span> os.path <span class="pink">as</span> osp




cert_home = osp.join(osp.dirname(osp.abspath(__file__)), <span class="violet">'../cert/my_key'</span>)

ssl_auth = Auth.SslCredential(osp.join(cert_home, <span class="violet">'client.key'</span>),
                              osp.join(cert_home, <span class="violet">'client.crt'</span>),
                              osp.join(cert_home, <span class="violet">'ca.crt'</span>))

key_auth = Auth.AuthCredential(<span class="violet">'emotionsdemo.com:50051'</span>, osp.join(cert_home, <span class="violet">'root.json'</span>), ssl_auth)</code></pre>
<!--        <p>-->
<!--            After successful authorization, you can use the modules supported by your key. For detailed information about the modules see Modules Info. Also, you can see an example on our GitHub page api-service/python/demo.py-->
<!--        </p>-->
<!--    </div>-->
<!--    <div id="classes" class="link">-->
<!--        <h2>Classes</h2>-->
<!--        <h3>Image</h3>-->
<!--        <p>-->
<!--            To process an image, you will first have to prepare it.-->
<!--        </p>-->
<!--        <pre><code>from api.utils.image import Image</code></pre>-->
<!--        <p>-->
<!--            You can initialize Image instance from the path-->
<!--        </p>-->
<!--        <pre><code>image = Image.from_file('some_image.jpg')</code></pre>-->
<!--        <p>-->
<!--            Or you can initialize Image instance from a cv2-like image-->
<!--        </p>-->
<!--        <pre><code>image = Image.from_bgr(bgr_image)</code></pre>-->
<!--        <p>-->
<!--            After initialization, you can process this image via the module which supports image processing, for example: <a href="#fd">Face Detector</a>-->
<!--        </p>-->
<!--        <p>-->
<!--            See example on the GitHub page.-->
<!--        </p>-->
            <p>
                After successful authorization, you can use the modules supported by your key. For detailed information about the modules see Modules Info. Also, you can see an example on our GitHub page api-service/python/demo.py
            </p>
        </div>
        <div id="classes">
            <h2>Classes</h2>
            <h3>Image</h3>
            <p>
                To process an image, you will first have to prepare it.
            </p>
            <pre><code>from api.utils.image import Image</code></pre>
            <p>
                You can initialize Image instance from the path
            </p>
            <pre><code>image = Image.from_file('some_image.jpg')</code></pre>
            <p>
                Or you can initialize Image instance from a cv2-like image
            </p>
            <pre><code>image = Image.from_bgr(bgr_image)</code></pre>
            <p>
                After initialization, you can process this image via the module which supports image processing, for example: <a href="#fd">Face Detector</a>
            </p>
            <p>
                See example on the GitHub page.
            </p>
        </div>
    </div>
    <h3>API modules</h3>
    <div id="fd" class="link">
        <h3>Face Detector</h3>
        <p>
            Face Detector module supports image processing. See how to <a href="#fd_image">initialize Image instance</a>
        </p>
        <h4 id="fd_init">Initialization</h4>
        <p>
            Import FaceDetector module to your project
        <pre><code>import api.recognition.FaceDetection as FD</code></pre>
        </p>
        <p>
            Create FaceDetector instance with your authentication key (see  <a href="#usage">ClientApi/Usage</a>)
        <pre><code>face_detector = FD.FaceDetector(key_auth)</code></pre>
        </p>
        <h4 id="fd_image">Image processing</h4>
        <p>
            To process an image, you will first need to create Image instance (see <a href="#classes">ClienAPI/Classes/Image</a>). Then, you can process the image via Face Detector. Note, that this is a blocking operation.
        </p>
        <pre><code>image_result, status, error_msg = face_detector.on_image(image)</code></pre>
        <p>
            If status==2, some errors occurred. You can see a detailed error description in error_msg. Otherwise, Face Detector processed the image correctly, and the result will appear in the image_result variable.
        </p>
        <p>
            Face Detector result type is dict, contains one field ‘FaceDetector’, and
        </p>
        <pre><code>image_result[‘FaceDetector’]</code></pre>
        <p>contains a list-like array of detected faces. Each face is a dict with ‘x’, ‘y’, ‘w’ and ‘h’ fields in cv-like coordinates.</p>

        <p>Sample result:</p>
        <pre><code>[{‘x’: 10, ‘y’: 20, ‘w’: 40, ‘h’: 45},
{‘x’: 100, ‘y’: 30, ‘w’: 45, ‘h’: 45}]</code></pre>
        <p>You can see more examples on the GitHub page.</p>
    </div>
    <div id="er" class="link">
        <h3>Emotion Recognition</h3>
        <p>
            Emotion Recognition module supports image processing. See how to <a href="#classes">initialize Image instance</a>
        </p>
        <h4 id="er_init">
            Initialization
        </h4>
        <p>
            Import EmotionRecognition module to your project
        <pre><code>import api.recognition.EmotionRecognition as ER</code></pre>
        </p>
        <p>
            Create EmotionRecognition instance with your authentication key (see <a href="#usage">ClientApi/Usage</a>)
        <pre><code>emo_recognizer = ER.EmotionRecognition(key_auth)</code></pre>
        </p>
        <h4 id="er_image">Image processing</h4>
        <p>
            To process an image, you need first create Image instance (see <a href="#classes">ClienAPI/Classes/Image</a>). Then, you can process the image via Emotion Recognition. Note, that this is a blocking operation.
        </p>
        <pre><code>image_result, status, error_msg = emo_recognizer.on_image(image)</code></pre>
        <p>
            If status==2, some errors occurred. You can see a detailed error description in error_msg. Otherwise, Emotion Recognition processed the image correctly, and the result will appear in the image_result variable.
        </p>
        <p>
            Emotion Recognition result type is dict, contains two fields: ‘FaceDetector’ and ‘EmotionRecognition’. Data in ‘FaceDetector’ field is identical to Face Detector result <a href="#fd_image">APIModules/FaceDetector/ImageProcessing</a>
        </p>
        <p>
            Sample result:
        </p>
        <pre><code>[{‘x’: 10, ‘y’: 20, ‘w’: 40, ‘h’: 45, "emotions": [
	[0.9151450991630554, "Surprise"],
	[0.07965227961540222, "Happiness"],
	[0.004168621730059385, "Anxiety"],
	[0.0005960435955785215, "Anger"],
	[0.00035987311275675893, "Neutral"],
	[7.289356290129945e-05, "Sadness"],
	[5.118385161040351e-06, "Disgust"]
]}]</code></pre>
        <p>You can see more examples on the GitHub page.</p>
    </div>
</div>

<?=$this->render("_form", ['model'=>$model, 'register'=>$register, 'reset'=>$reset]) ?>
