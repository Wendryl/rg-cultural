let selectize = null;

window.onload = () => {
  initializeSelectize();
}

function initializeSelectize() {
  $(function () {
    selectize = $("#categories").selectize({
      create: (input) => {
        return {
          value: input,
          text: input
        }
      },
      render: {
        option_create: function(data, escape) {
          return '<div class="create">Adicionar <strong>' + escape(data.input) + '</strong>&hellip;</div>';
        }
      }
    });

    selectize.on('change', () => {
      document.querySelector('input[name="user_categories"]').value = JSON.stringify(selectize[0].selectize.getValue());
    })
  });
}

window.resetControl = (event, controlSelector) => {
  document.querySelector(controlSelector).value = '';
  document.querySelector('#img-preview').innerHTML = '';
  event.target.setAttribute('disabled', 'true');
}

window.handleFileInput = (event) => {
  const wrapper = document.querySelector('#img-preview');
  const files = event.target.files;

  if (!files.length > 0) return;

  document.querySelector('#reset-file-input').removeAttribute('disabled');

  Array.from(files)
    .forEach(f => {
      const img = document.createElement('img');
      img.src = URL.createObjectURL(f);
      img.classList.add('pic-thumb');
      wrapper.append(img);
    });
}

window.handlePictureClick = (inputSelector) => {
  document.querySelector(inputSelector).click();
}

window.setProfilePicture = (event, previewSelector) => {
  const files = event.target.files;

  if (files.length > 0) {
    const img = URL.createObjectURL(files[0]);
    document.querySelector(previewSelector).src = img;
  }
}

window.setCategories = (categories) => {
  setTimeout(() => {
    const $select = $('#categories').selectize();
    const selectize = $select[0].selectize;

    selectize.setValue(categories.map(p => p.category_id));
  }, 500);
}
