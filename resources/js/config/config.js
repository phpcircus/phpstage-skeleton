export const config = {
    apiUrl: process.env.MIX_API_URL,
    appName: process.env.MIX_APP_NAME,
    timezone: process.env.MIX_FRONTEND_TIMEZONE,
    pusherKey: process.env.MIX_PUSHER_APP_KEY,
    pusherCluster: process.env.MIX_PUSHER_APP_CLUSTER,
    admin: {
        name: process.env.MIX_ADMIN_NAME,
        email: process.env.MIX_ADMIN_EMAIL,
    },
}
