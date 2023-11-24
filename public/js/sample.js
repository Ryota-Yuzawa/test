// 外部ファイル: custom-script.js

$(document).ready(function() {
    // CSRFトークンの設定
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    if (csrfToken) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
    }

    // 検索フォームの送信処理
    $('#searchForm').submit(function(e) {
        e.preventDefault();
        var searchFormAction = $(this).attr('action'); // Formのaction属性からURLを取得
        $.ajax({
            type: "GET",
            url: searchFormAction, // Formのaction属性を使用
            data: $(this).serialize(),
            success: function(data) {
                $('#productTable').find('tbody').html($(data).find('tbody').html());
            }
        });
    });

    // テーブルソーターの初期化
    $('#table').tablesorter();

    // 削除ボタンのクリックイベント
    $(document).on('click', '.delete-button', function() {
        const form = $(this).closest('.delete-form');
        const productId = form.data('product-id');
        const deleteUrl = form.data('delete-url'); // データ属性から削除URLを取得
        if (confirm('本当に削除しますか？')) {
            $.ajax({
                type: 'POST',
                url: deleteUrl, // データ属性から取得したURLを使用
                data: form.serialize(),
                success: function(response) {
                    if (response.success) {
                        form.closest('tr').fadeOut("slow", function() {
                            $(this).remove();
                        });
                    } else {
                        alert('削除に失敗しました');
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    alert('削除処理に問題が発生しました。');
                }
            });
        }
    });
});
