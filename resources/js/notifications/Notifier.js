export let notifier = {
    success: (callback, snotify) => {
        return callback.on('destroyed', () => {
            snotify.clear();
        });
    },
};
