import random

money = 100

#Write your game of chance functions here

#Coin flip game
def coin_flip(guess, bet):
    if bet <= 0:
        print("Your bet must be above 0.")
        return 0
    if (guess == "Heads" and result == 1) or (guess == "Tails" and result == 2):
        print("You won " + str(bet)+" dollars!")
        return bet
    else:
        print("You lost " + str(bet)+" dollars!")
        return -bet

playing = True

while playing == True:
    number = random.randint(1, 2)
    result = input("Heads or Tails?: ")
    # HEads is thrown and guessed
    if number == 1 and result == "heads":
        print("You flipped a Head and guessed a Head! Very nice.")
        throw = input("Do you wish to throw again?")
    
    #Tails is thrown and guessed
    elif number == 2 and result == "tails":
        print("You flipped a Tail and guessed a Tail! Well done.")
        throw = input("Do you wish to throw again?")
    
    #Heads is thrown and tails is guessed
    elif number == 1 and result == "tails":
        print("You flipped a Head and guessed a Tail! Oops!")
        throw = input("Do you wish to throw again?")

    #Tails is thrown and heads is guessed
    elif number == 2 and result == "heads":
        print("You flipped a Tail and guessed a Head! Gosh dang it.")
        throw = input("Do you wish to throw again?")

    #If neither heads of tails is guessed
    else:
        print("You entered an incorrect value.")
        throw = input("Do you wish to throw again?")

    if throw == "yes":
        playing = True
    elif throw == "no":
        playing == False

#Cho Han game

def Cho_Han(guess, bet):
    if bet <= 0:
        print("Your bet must be above 0.")
    return 0

    dice1 = random.randint(1, 6)
    dice2 = random.randint(1, 6)
    total = dice1 + dice2
    print("The sum of the two dice is " + str(total))

    if guess == "Even" and total % 2 == 0:
        print("You won " + str(bet)+" dollars!")
        return bet
    elif guess == "Odd" and total % 2 == 1:
        print("You won " + str(bet)+" dollars!")
        return bet
    else:
        print("You lost " + str(bet)+" dollars!")
        return -bet
  
    player1 = 0
    player2 = 0
    rounds = 1
    while rounds != 3:
        print("Round " + str(rounds))
        player1 = dice_roll()
        player2 = dice_roll()
        print("Player 1 roll: " + str(player1))
        print("Player 2 roll: " + str(player2))


        if player1 == player2:
            print("Draw!")
        elif player1 > player2:
            print("Player 1 wins!")
        else:
            print("Player 2 wins!")

        rounds = rounds +1

def dice_roll():
    diceRoll = random.randint(1, 6)
    return diceRoll


def pick_a_card(bet):
    if bet <= 0:
        print("Your bet must be above 0.")
    return 0

    myCard = random.randint(1, 10)
    theirCard = random.randint(1, 10)
    print("Your card was " + str(myCard))
    print("Their card was " + str(theirCard))
    if myCard > theirCard:
        print("You won " + str(bet)+" dollars!")
        return bet
    elif myCard < theirCard:
        print("You lost " + str(bet)+" dollars!")
        return -bet
    else:
        print("Draw")
        return 0

def roulette(guess, bet):
    if bet <= 0:
        print("Your bet must be above 0.")
        return 0
    
        result = random.randint(0, 37)
    if result == 37:
        print("It landed on 00!")
    else:
        print("The wheel landed on " + str(result))

    if guess == "Even" and result % 2 == 0 and result != 0:
        print(str(result) + " is an even number.")
        print("You won " + str(bet)+" dollars!")
        return bet

    elif guess == "Odd" and result % 2 == 1 and result != 37:
        print(str(result) + " is an odd number.")
        print("You won " + str(bet)+" dollars!")
        return bet

    elif guess == result:
        print("You guessed " + str(guess) + " and the result was " + str(result))
        print("You won " + str(bet * 35)+" dollars!")
        return bet * 35

    else:
        print("You lost " + str(bet)+" dollars!")
        return -bet




#Call your game of chance functions here

money += coin_flip("Heads", 10)
money += Cho_Han("Even", 2)
money += pick_a_card(5)
money += roulette("Even", 10)
money += roulette(3, 1)
money += roulette("Odd", money)
print("Your total amount of money is " + str(money))
