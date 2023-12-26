const findTheIndexes = (listOfNumbers, TargetNumber) => {
  let Array = [];

  listOfNumbers.forEach((number, index) => {
    listOfNumbers.forEach((innnumber, innindex) => {
      const sum = innnumber + number;
      if (sum == TargetNumber) {
        Array = [innindex, index];
      }
    });
  });

  if (Array.length > 0) {
    console.log(Array);
    return Array;
  } else {
    console.log(null);
    return null;
  }
};

findTheIndexes([8, 4, 2, 1, 6, 7, 8, 9], 10);
