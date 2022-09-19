window.onload = () => {
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

