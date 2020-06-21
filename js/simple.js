var dl = new Vue({
  el: '#dl',
  data: {
    selectedSource: '',
    sources: [
      {id: 1, name: 'MEGA'},
      {id: 2, name: '日本鯖'},
    ],
  },
  methods: {
    downloadFrom: function() {
      if (this.selectedSource == 1) {
        var mega = document.getElementById("mega");
        var japan = document.getElementById("japan");
        japan.element.classList.add('hidden');
        mega.element.classList.remove('hidden');
      } else if (this.selectedSource == 2) {
        var mega = document.getElementById("mega");
        var japan = document.getElementById("japan");
        japan.element.classList.remove('hidden');
        mega.element.classList.add('hidden');
      } else {
        alert('Invalid value!!')
      }
    }
  }
})