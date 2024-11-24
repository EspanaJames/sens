exports.handler = async (event, context) => {
  const data = {
    distance_cm: 100,
    distance_inches: 39.37
  };
  return {
    statusCode: 200,
    body: JSON.stringify(data)
  };
};
