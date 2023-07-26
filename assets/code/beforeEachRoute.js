router.beforeEach((to, from, next) => {
    if (!to.meta.middleware) {
        return next()
    }
    const userStore = useUserStore();

    const middleware = to.meta.middleware;
    const context = {
        to,
        from,
        next,
        userStore
    }

    return middleware[0]({
        ...context,
        next: middlewarePipeline(context, middleware, 1)
    })
})