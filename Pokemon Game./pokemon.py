class Pokemon:
    # Pokemon's attributes
    def __init__(self, name, type, level = 5):
        self.name = name
        self.level = level
        self.health = level * 5
        self.max_health = level * 5
        self.type = type
        self.knocked_out = False


    def __lose_health__(self, amount):
        # Losing Health
        self.health -= amount
        if self.health <= 0:
            # To make sure health doesn't go negative we set health to 0
            self.health = 0
            self.knocked_out = True
        else: 
            print("{name} lost {amount} and is now at {health} health!".format(name = self.name, health = self.health))

    def __revive__(self):
        # Revive pokemon if health is at 0
        self.knocked_out == False
        if self.health == 0:
            self.health = 1
        print("{name} has been revived".format(name = self.name))
            


    def __gain_health__(self, amount):
        # Gain Health and/or Revive
        if self.health == 0:
            self.revive()
        self.health += amount
        if self.health > self.max_health:
            self.health = self.max_health
        print("{name} has been healed! They are now at {health} health.".format(health = self.health, name = self.name))
        
    def __knocked_out__(self, health):
        # Knocked out if health reaches 0
        self.knocked_out = True
        if self.health != 0:
            self.health == 0
        print("{name} has been knocked out!".format(name = self.name, health = self.health))

    def __attack__(self, pokemon2):
        # If pokemon is knocked out, they can't attack
        if self.is_knocked_out:
            print("{name} can't attack because it's knocked out".format(name = self.name))

            # If we are at an advantage, do double damage
        if (self.type == "fire" and pokemon2.type == "grass") or (self.type == "grass" and pokemon2.type == "water") or (self.type == "water" and pokemon2.type == "fire"):
            print("{self_name} attacked {pokemon2_name} for {damage} damage!".format(self_name = self.name, pokemon2_name = pokemon2.name, damage = self.level * 2))
            print("It's super effective")
            pokemon2.lose_health(self.level * 2)

        # If we are at a disadvantage, deal half damage
        if (self.type == "grass" and pokemon2.type == "fire") or (self.type == "water" and pokemon2.type == "grass") or (self.type == "fire" and pokemon2.type == "water"):
            print("{self_name} attacked {pokemon2_name} for {damage} damage!".format(self_name = self.name, pokemon2_name = pokemon2.name, damage = self.level * 0.5))
            print("It's super effective")
            pokemon2.lose_health(self.level * 0.5)

class Trainer:
    # Trainer inventory and attributes, starting pokemon etc
    def __init__(self, name, pokemon_list, potions):
        self.name = name
        self.pokemons = pokemon_list
        self.potions = potions
        self.current_pokemon = 0

    def __attack_trainer2__(self, trainer2):
        # Attack! Our active pokemon attacks trainer 2's active pokemon
        my_pokemon = self.pokemons[self.current_pokemon]
        their_pokemon = trainer2.pokemons[trainer2.current_pokemon]
        my_pokemon.attack(their_pokemon)

    def __use_potion__(self):
        # Potions heal current pokemon for 50 Health Points (out of 100)
        if self.potions == 0:
            print("Potion used on {name}!".format(name = self.pokemons[self.current_pokemon].name))
            self.pokemons = self.pokemons[self.current_pokemon].gain_health(50)

    def __switch_pokemon__(self, fresh_pokemon):
        # Switch pokemon from current to a fresh pokemon
        # Make sure "fresh" pokmon is not knocked out already
        if self.pokemons[fresh_pokemon].is_knocked_out:
            print("{name} is knocked out. You can not make it your current pokemon".format(name = self.pokemons[fresh_pokemon].name))
            
        elif fresh_pokemon == self.current_pokemon:
            print("{name} is already your active pokemon".format(name = self.pokemons[fresh_pokemon].name))

            # Switch the pokemon
        else:
            self.current_pokemon = fresh_pokemon
            print("Go {name}, it's your turn!".format(name = self.pokemons[self.current_pokemon].name))

class Pikachu(Pokemon):
    def __init__(self, level = 8):
        super().__init__("Pikachu", "Electricity", level)

class Bulbasaur(Pokemon):
    def __init__(self, level = 6):
        super().__init__("Bulbasaur", "Grass", level)

class Charmander(Pokemon):
    def __init__(self, level = 5):
        super().__init__("Charmander", "Fire", level)
        
class Squirtle(Pokemon):
    def __init__(self, level = 3):
        super().__init__("Squirtle", "Water", level)



# Pokemon and their lvls
poke1 = Pikachu(8)
poke2 = Bulbasaur(6)
poke3 = Charmander(5)
poke4 = Squirtle(3)

print(poke1)
print(poke2)
print(poke3)
print(poke4)

#Trainer Ash, Brock & their pokemon
trainer_Ash = Trainer([poke1, poke3, poke4], 7, "Ash")
trainer_Brock = Trainer([poke2, poke3], 10, "Brock")

print(trainer_Ash)
print(trainer_Brock)

trainer_Ash.__attack_trainer2__
print(trainer_Ash)