import fileinput

def is_number(s):
    try:
        float(s)
        return True
    except ValueError:
        return False

for line in fileinput.input():
	numbers = line.rstrip().split( ' ' )
	numbers = filter( is_number, numbers )
	print reduce(lambda x, y: int(x)+int(y), numbers )
