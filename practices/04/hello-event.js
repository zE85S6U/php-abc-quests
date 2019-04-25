'use strict'
{
  $(function () {
    $('#trigger').on('click', function () {
      $('#target').text('変更されました！');
    });
  });
}