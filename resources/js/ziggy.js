const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"landing":{"uri":"\/","methods":["GET","HEAD"]},"register":{"uri":"register","methods":["GET","HEAD"]},"login":{"uri":"login","methods":["GET","HEAD"]},"movies":{"uri":"movies","methods":["GET","HEAD"]},"series":{"uri":"series","methods":["GET","HEAD"]},"detail":{"uri":"detail\/{type}\/{id}","methods":["GET","HEAD"],"parameters":["type","id"]},"logout":{"uri":"logout","methods":["POST"]},"save.rating":{"uri":"save-rating","methods":["POST"]},"storage.local":{"uri":"storage\/{path}","methods":["GET","HEAD"],"wheres":{"path":".*"},"parameters":["path"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
