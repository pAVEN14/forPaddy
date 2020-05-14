let humanScore = 0;
let computerScore = 0;
let currentRoundNumber = 1;

// Write your code below:
const generateTarget = () => {
  return Math.floor(Math.random() * 10);
}

const compareGuesses = (humanGuess, pcGuess, secretGuess) => {

  const humanRemain = Math.abs(secretGuess - humanGuess)

  const pcRemain = Math.abs(secretGuess - pcGuess)

  return humanRemain <= pcRemain;
}

const updateScore = winner => {
    if (winner === "Human") {
      humanScore++;
    } else if (winner === "Computer") {
      computerScore++;
    }
}

const advanceRound() {
  currentRoundNumber++;
}