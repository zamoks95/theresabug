module.exports = ({ env }) => ({
  auth: {
    secret: env('ADMIN_JWT_SECRET', '72f8f3c467c9093940eee52678f26558'),
  },
});
