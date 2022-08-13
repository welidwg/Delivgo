var pusher = new Pusher("33ae8c9470ab8fad0744", {
    cluster: "eu",
});

Pusher.logToConsole = false;

var channel = pusher.subscribe('notif-{{ Auth::user()->user_id }}');
channel.bind('notif', function(data) {
    audio.play();

    toastr.info(`
        <strong>${data.notif.title}</strong>
        ${data.notif.content}
        `)

    let permission = Notification.requestPermission();
    if (Notification.permission == "granted") {

        const notif = new Notification(data.notif.title, {
            body: data.notif.content,
            icon: "{{ asset('/images/logo/logoOrange.PNG') }}"
        });
    }
});