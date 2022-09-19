window.onload = () => {
  initializeSelectize();
}

function initializeSelectize() {
  $(function () {
    $("#categories").selectize({
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
