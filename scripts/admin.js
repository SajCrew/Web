const titleInput = document.getElementById('title');
const subtitleInput = document.getElementById('description');
const authorNameInput = document.getElementById('author-name');
const dateInput = document.getElementById('post-date');
const bigImageInput = document.getElementById('big-image');
const smallImageInput = document.getElementById('small-image');
const authorImageInput = document.getElementById('author-photo');
const FormDatas = {
  "title": '',
  "subtitle": '',
  "content": '',
  "author": '',
  "author_url": '',
  "publish_date": '',
  "image_url": '',
  "featured": 0,
  "tag_type": '',
  "tag_text": ''
}

titleInput.addEventListener('change', () => CopyText(titleInput, 'article-title-copy'));
titleInput.addEventListener('change', () => CopyText(titleInput, 'post-card-title-copy'));

subtitleInput.addEventListener('change', () => CopyText(subtitleInput, 'article-subtitle-copy'));
subtitleInput.addEventListener('change', () => CopyText(subtitleInput, 'post-card-subtitle-copy'));

authorNameInput.addEventListener('change', () => CopyText(authorNameInput, 'author-name-copy'));

dateInput.addEventListener('change', () => CopyDate(dateInput, 'post-card-date-copy'));

bigImageInput.addEventListener('change', () => copyImage(bigImageInput, 'preview-big', ''));
bigImageInput.addEventListener('change', () => copyImage(bigImageInput, 'big-photo-main', ''));
bigImageInput.addEventListener('change', () => UpdateArticlePreview());

smallImageInput.addEventListener('change', () => copyImage(smallImageInput, 'post-card-preview', ''));
smallImageInput.addEventListener('change', () => copyImage(smallImageInput, 'small-photo-main', 'image_url'));
smallImageInput.addEventListener('change', () => UpdatePostCardPreview());


authorImageInput.addEventListener('change', () => copyImage(authorImageInput, 'author-preview-photo', ''));
authorImageInput.addEventListener('change', () => copyImage(authorImageInput, 'author-photo-main', 'author_url'));
authorImageInput.addEventListener('change', () => UpdateAuthorImage());

function copyImage(from, to, toList) {
    const file = from.files[0];
    if (file) {
        const reader = new FileReader();
        const imageContainer = document.getElementById(to);

        reader.onload = function (e) {
            const imageUrl = e.target.result;
            imageContainer.style.backgroundImage = `url(${imageUrl})`;
			if (toList != ''){
				FormDatas[toList] = imageUrl;
			}
        };

        reader.readAsDataURL(file);
    }
    else {
        console.log('Error at reading image!\n');
    }
}

function CopyText(from, e) {
    let elem = document.getElementById(e);
    elem.textContent = from.value;
}

function CopyDate(from, e) {
    const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
    var elem = document.getElementById(e);
    elem.textContent = (new Date(from.value)).toLocaleDateString("en-GB", options);
}

function UpdateArticlePreview() {
    let bigImageMain = document.getElementById('big-image-label');
    bigImageMain.style.display = 'none';

    let newUploadButton = document.getElementById('delete-big-photo');
    newUploadButton.style.display = 'flex';

    let bigPhotoDiscription = document.getElementById('big-photo-desc');
    bigPhotoDiscription.style.display = 'none';

    let blockBigMain = document.getElementById('big-photo-main');
    blockBigMain.style.border = '1px solid #d3d3d3';
}

function RemoveArticlePhoto() {
    const bigImageMain = document.getElementById('big-image-label');
    bigImageMain.style.display = 'flex';

    const bigPhotoDiscription = document.getElementById('big-photo-desc');
    bigPhotoDiscription.style.display = 'flex';

    const newUploadButton = document.getElementById('delete-big-photo');
    newUploadButton.style.display = 'none';

    bigImageInput.value = '';

    const blockBigPreview = document.getElementById('preview-big');
    blockBigPreview.style.backgroundImage = 'none';

    const blockBigMain = document.getElementById('big-photo-main');
    blockBigMain.style.backgroundImage = 'none';
    blockBigMain.style.border = '1px dashed #d3d3d3';
}

function UpdatePostCardPreview() {
    let smallImageMain = document.getElementById('small-image-label');
    smallImageMain.style.display = 'none';

    let newSmallUploadButton = document.getElementById('delete-small-photo');
    newSmallUploadButton.style.display = 'flex';

    let smallPhotoDiscription = document.getElementById('small-photo-desc');
    smallPhotoDiscription.style.display = 'none';

    let blockSmallMain = document.getElementById('small-photo-main');
    blockSmallMain.style.border = '1px solid #d3d3d3';
}

function RemovePostCardPhoto() {
    let bigImageMain = document.getElementById('small-image-label');
    bigImageMain.style.display = 'flex';

    let bigPhotoDiscription = document.getElementById('small-photo-desc');
    bigPhotoDiscription.style.display = 'flex';

    let newUploadButton = document.getElementById('delete-small-photo');
    newUploadButton.style.display = 'none';

    bigImageInput.value = '';

    let blockBigPreview = document.getElementById('post-card-preview');
    blockBigPreview.style.backgroundImage = 'none';

    let blockBigMain = document.getElementById('small-photo-main');
    blockBigMain.style.backgroundImage = 'none';
    blockBigMain.style.border = '1px dashed #d3d3d3';
}

function UpdateAuthorImage() {
    let toRemove = document.getElementById('upload-to-delete');
    toRemove.style.display = 'none';

    let toRemoveImg = document.getElementById('author-to-delete');
    toRemoveImg.style.display = 'none';

    let toShow = document.getElementById('delete-photo');
    toShow.style.display = 'flex';

    let blockToShow = document.getElementById('author-photo-main');
    blockToShow.style.border = 'none';
}

function RemoveAuthorImage() {
    let toRemove = document.getElementById('upload-to-delete');
    toRemove.style.display = 'flex';

    let toRemoveImg = document.getElementById('author-to-delete');
    toRemoveImg.style.display = 'block';

    let toShow = document.getElementById('delete-photo');
    toShow.style.display = 'none';

    let blockToShow = document.getElementById('author-photo-main');
    blockToShow.style.border = '1px dashed #d3d3d3';
    blockToShow.style.backgroundImage = 'none';

    let previewBlock = document.getElementById('author-preview-photo');
    previewBlock.style.backgroundImage = 'none';

    authorImageInput.value = '';
}

function ValidateForm() {
    const form = document.getElementById('main-form');
    var isEmpty = false;
	console.log(form);
    for (let i = 0; i < form.elements.length; i++) {
        const element = form.elements[i];
		console.log(element);
        if (element.value === '') {
            isEmpty = true;
            element.classList.remove('form__input-field_input');
            element.classList.add('form__input-field_input-error');
            let errText = document.getElementById(element.id + '-error');
            errText.style.display = 'flex';
        }else{
            element.classList.remove('form__input-field_input-error');
            element.classList.add('form__input-field_input');
            let errText = document.getElementById(element.id + '-error');
            errText.style.display = 'none';
            
        }
    }

    const errBlock = document.getElementById('error');
    const succBlock = document.getElementById('succes');
    if (isEmpty) {
        errBlock.style.display = 'flex';
        succBlock.style.display = 'none';
    } else {
        errBlock.style.display = 'none';
        succBlock.style.display = 'flex';
        displayFormData('main-form');
    }
}

async function displayFormData(form) {
    var formData = new FormData(document.getElementById(form));
	var element = document.getElementById('content-form').elements[0];
	formData.append('content', element.value);
    for (const [key, value] of formData.entries()) {
        if (value instanceof File) {
            readAndDisplayFile(value);
        } else {
            FormDatas[key] = value;         
        }
    }
    console.log(FormDatas);
	console.log(JSON.stringify(FormDatas));
	var url = "http://localhost/api.php";
	for (var i = 0; i < 1; i++) {
		response = await fetch(url, {
			method: "POST",
		body: JSON.stringify(FormDatas)})
	}
}



function readAndDisplayFile(file) {
    const reader = new FileReader();
    reader.onload = function (e) {
        console.log(`${file.name}: ${e.target.result}`);
    };
    reader.readAsDataURL(file);
}